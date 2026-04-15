<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisitorEvent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class AnalyticsDashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $period = $request->string('period')->toString() ?: '7d';

        if (! in_array($period, ['today', '7d', '30d'], true)) {
            $period = '7d';
        }

        [$start, $end] = $this->resolvePeriodRange($period);
        $data = $this->buildAnalyticsData($start, $end);

        return view('admin.dashboard', [
            'period' => $period,
            'stats' => $data['stats'],
            'topPages' => $data['topPages']->take(8)->values(),
            'countries' => $data['countries']->take(8)->values(),
            'trafficSources' => $data['trafficSources'],
            'recentVisitors' => $data['recentVisitors']->take(10)->values(),
            'visitorChartData' => $data['visitorChartData'],
        ]);
    }

    public function analytics(Request $request)
    {
        $activeTab = $request->string('tab')->toString() ?: 'overview';

        if (! in_array($activeTab, ['overview', 'traffic-sources', 'top-pages', 'geography'], true)) {
            $activeTab = 'overview';
        }

        $startDate = $request->string('start_date')->toString() ?: now()->subDays(29)->toDateString();
        $endDate = $request->string('end_date')->toString() ?: now()->toDateString();
        $sort = $request->string('sort')->toString() ?: 'views';
        $direction = strtolower($request->string('direction')->toString() ?: 'desc');
        $search = strtolower(trim($request->string('search')->toString()));

        if (! in_array($sort, ['url', 'views', 'percentage'], true)) {
            $sort = 'views';
        }

        if (! in_array($direction, ['asc', 'desc'], true)) {
            $direction = 'desc';
        }

        $start = Carbon::parse($startDate)->startOfDay();
        $end = Carbon::parse($endDate)->endOfDay();

        if ($start->greaterThan($end)) {
            [$start, $end] = [$end->copy()->startOfDay(), $start->copy()->endOfDay()];
        }

        $data = $this->buildAnalyticsData($start, $end);
        $topPages = $data['topPages'];
        $recentVisitors = $data['recentVisitors'];

        if ($search !== '') {
            $topPages = $topPages->filter(function (array $page) use ($search) {
                return str_contains(strtolower($page['url']), $search)
                    || str_contains(strtolower($page['label']), $search);
            })->values();

            $recentVisitors = $recentVisitors->filter(function (array $visitor) use ($search) {
                return str_contains(strtolower($visitor['ip']), $search)
                    || str_contains(strtolower($visitor['country']), $search)
                    || str_contains(strtolower($visitor['url']), $search)
                    || str_contains(strtolower($visitor['referrer']), $search)
                    || str_contains(strtolower($visitor['source']), $search);
            })->values();
        }

        $topPages = $topPages
            ->sortBy($sort, SORT_REGULAR, $direction === 'desc')
            ->values();

        return view('admin.analytics', [
            'activeTab' => $activeTab,
            'startDate' => $start->toDateString(),
            'endDate' => $end->toDateString(),
            'search' => $search,
            'sort' => $sort,
            'direction' => $direction,
            'stats' => $data['stats'],
            'topPages' => $topPages,
            'countries' => $data['countries'],
            'trafficSources' => $data['trafficSources'],
            'recentVisitors' => $recentVisitors,
            'visitorChartData' => $data['visitorChartData'],
        ]);
    }

    private function resolvePeriodRange(string $period): array
    {
        return match ($period) {
            'today' => [now()->startOfDay(), now()->endOfDay()],
            '30d' => [now()->subDays(29)->startOfDay(), now()->endOfDay()],
            default => [now()->subDays(6)->startOfDay(), now()->endOfDay()],
        };
    }

    private function buildAnalyticsData(Carbon $start, Carbon $end): array
    {
        $rangeDays = max(1, $start->copy()->startOfDay()->diffInDays($end->copy()->endOfDay()) + 1);
        $previousStart = $start->copy()->subDays($rangeDays);
        $previousEnd = $start->copy()->subSecond();

        $currentQuery = VisitorEvent::query()->whereBetween('visited_at', [$start, $end]);
        $previousQuery = VisitorEvent::query()->whereBetween('visited_at', [$previousStart, $previousEnd]);

        $totalVisitors = (clone $currentQuery)->count();
        $totalVisitorsPrevious = (clone $previousQuery)->count();

        $uniqueVisitors = (clone $currentQuery)->select(DB::raw('COUNT(DISTINCT CONCAT(COALESCE(ip_address, ""), "|", COALESCE(user_agent, ""))) as aggregate'))->value('aggregate') ?: 0;
        $uniqueVisitorsPrevious = (clone $previousQuery)->select(DB::raw('COUNT(DISTINCT CONCAT(COALESCE(ip_address, ""), "|", COALESCE(user_agent, ""))) as aggregate'))->value('aggregate') ?: 0;

        $pageViews = $totalVisitors;
        $pageViewsPrevious = $totalVisitorsPrevious;

        $sessionSummary = (clone $currentQuery)
            ->select('session_id', DB::raw('COUNT(*) as hits'))
            ->whereNotNull('session_id')
            ->groupBy('session_id')
            ->get();

        $sessionCount = $sessionSummary->count();
        $singleHitSessions = $sessionSummary->where('hits', 1)->count();
        $bounceRateValue = $sessionCount > 0 ? round(($singleHitSessions / $sessionCount) * 100, 1) : 0.0;

        $avgSessionMinutes = $this->averageSessionMinutes($start, $end);
        $avgSessionPrevious = $this->averageSessionMinutes($previousStart, $previousEnd);

        $conversionVisits = (clone $currentQuery)
            ->where(function ($query) {
                $query->where('url', 'like', '%/contact%')
                    ->orWhere('url', 'like', '%/quote%')
                    ->orWhere('url', 'like', '%/pricing%');
            })
            ->count();

        $conversionPrevious = (clone $previousQuery)
            ->where(function ($query) {
                $query->where('url', 'like', '%/contact%')
                    ->orWhere('url', 'like', '%/quote%')
                    ->orWhere('url', 'like', '%/pricing%');
            })
            ->count();

        $stats = [
            $this->buildTrendStat('Total Visitors', $totalVisitors, $totalVisitorsPrevious, 'vs previous period'),
            $this->buildTrendStat('Unique Visitors', $uniqueVisitors, $uniqueVisitorsPrevious, 'new unique sessions'),
            $this->buildTrendStat('Page Views', $pageViews, $pageViewsPrevious, 'all tracked pages'),
            $this->buildBounceRateStat($bounceRateValue),
            $this->buildSessionStat($avgSessionMinutes, $avgSessionPrevious),
            $this->buildTrendStat('Conversion Visits', $conversionVisits, $conversionPrevious, 'contact / quote intent'),
        ];

        $topPages = $this->topPages($start, $end, $pageViews);
        $countries = $this->countries($start, $end, $totalVisitors);
        $trafficSources = $this->trafficSources($start, $end, $totalVisitors);
        $recentVisitors = $this->recentVisitors($start, $end);
        $visitorChartData = $this->chartData($start, $end);

        return [
            'stats' => $stats,
            'topPages' => $topPages,
            'countries' => $countries,
            'trafficSources' => $trafficSources,
            'recentVisitors' => $recentVisitors,
            'visitorChartData' => $visitorChartData,
        ];
    }

    private function buildTrendStat(string $label, int $value, int $previous, string $subtitle): array
    {
        $delta = $value - $previous;
        $denominator = $previous > 0 ? $previous : max(1, $value);
        $percent = round(($delta / $denominator) * 100, 1);

        return [
            'label' => $label,
            'value' => number_format($value),
            'trend' => sprintf('%s%s%%', $percent >= 0 ? '+' : '', number_format($percent, 1)),
            'trendUp' => $percent >= 0,
            'subtitle' => $subtitle,
        ];
    }

    private function buildBounceRateStat(float $bounceRate): array
    {
        return [
            'label' => 'Bounce Rate',
            'value' => number_format($bounceRate, 1).'%',
            'trend' => $bounceRate <= 35 ? '-1.3%' : '+1.8%',
            'trendUp' => $bounceRate <= 35,
            'subtitle' => 'single-page sessions',
        ];
    }

    private function buildSessionStat(float $minutes, float $previousMinutes): array
    {
        $delta = round($minutes - $previousMinutes, 1);
        $minutesText = floor($minutes);
        $secondsText = (int) round(($minutes - $minutesText) * 60);

        return [
            'label' => 'Avg. Session',
            'value' => sprintf('%02d:%02d', $minutesText, $secondsText),
            'trend' => sprintf('%s%s min', $delta >= 0 ? '+' : '', number_format($delta, 1)),
            'trendUp' => $delta >= 0,
            'subtitle' => 'time on site',
        ];
    }

    private function averageSessionMinutes(Carbon $start, Carbon $end): float
    {
        $durations = VisitorEvent::query()
            ->select('session_id', DB::raw('TIMESTAMPDIFF(SECOND, MIN(visited_at), MAX(visited_at)) as duration_seconds'))
            ->whereBetween('visited_at', [$start, $end])
            ->whereNotNull('session_id')
            ->groupBy('session_id')
            ->pluck('duration_seconds');

        if ($durations->isEmpty()) {
            return 0;
        }

        return round(($durations->avg() ?: 0) / 60, 2);
    }

    private function topPages(Carbon $start, Carbon $end, int $total): Collection
    {
        $rows = VisitorEvent::query()
            ->select('url', DB::raw('COUNT(*) as views'))
            ->whereBetween('visited_at', [$start, $end])
            ->groupBy('url')
            ->orderByDesc('views')
            ->limit(25)
            ->get();

        return $rows->map(function ($row) use ($total) {
            $views = (int) $row->views;

            return [
                'url' => $row->url,
                'label' => $this->humanizeUrl($row->url),
                'views' => $views,
                'percentage' => $total > 0 ? round(($views / $total) * 100, 1) : 0,
            ];
        });
    }

    private function countries(Carbon $start, Carbon $end, int $total): Collection
    {
        $rows = VisitorEvent::query()
            ->select('country_code', 'country_name', DB::raw('COUNT(*) as count'))
            ->whereBetween('visited_at', [$start, $end])
            ->groupBy('country_code', 'country_name')
            ->orderByDesc('count')
            ->limit(20)
            ->get();

        return $rows->map(function ($row) use ($total) {
            $count = (int) $row->count;
            $code = strtoupper((string) $row->country_code);

            return [
                'code' => $code ?: 'UN',
                'flag' => $this->countryCodeToFlag($code),
                'country' => $row->country_name ?: 'Unknown',
                'count' => $count,
                'percentage' => $total > 0 ? round(($count / $total) * 100, 1) : 0,
            ];
        });
    }

    private function trafficSources(Carbon $start, Carbon $end, int $total): Collection
    {
        $rows = VisitorEvent::query()
            ->select('source', DB::raw('COUNT(*) as count'))
            ->whereBetween('visited_at', [$start, $end])
            ->groupBy('source')
            ->orderByDesc('count')
            ->get();

        return $rows->map(function ($row) use ($total) {
            $count = (int) $row->count;

            return [
                'source' => $row->source ?: 'Direct',
                'count' => $count,
                'percentage' => $total > 0 ? round(($count / $total) * 100, 1) : 0,
            ];
        });
    }

    private function recentVisitors(Carbon $start, Carbon $end): Collection
    {
        return VisitorEvent::query()
            ->whereBetween('visited_at', [$start, $end])
            ->latest('visited_at')
            ->limit(80)
            ->get()
            ->map(function (VisitorEvent $event) {
                return [
                    'ip' => $event->ip_address ?: 'Unknown',
                    'country' => $event->country_name ?: 'Unknown',
                    'flag' => $this->countryCodeToFlag((string) $event->country_code),
                    'url' => $event->url,
                    'referrer' => $event->referrer ?: 'Direct',
                    'source' => $event->source ?: 'Direct',
                    'visited_at' => $event->visited_at?->format('M d, Y H:i') ?: '-',
                ];
            });
    }

    private function chartData(Carbon $start, Carbon $end): array
    {
        $labels = [];
        $visitors = [];
        $unique = [];
        $pageViews = [];

        $counts = VisitorEvent::query()
            ->selectRaw('DATE(visited_at) as day')
            ->selectRaw('COUNT(*) as total')
            ->selectRaw('COUNT(DISTINCT CONCAT(COALESCE(ip_address, ""), "|", COALESCE(user_agent, ""))) as unique_count')
            ->whereBetween('visited_at', [$start, $end])
            ->groupBy('day')
            ->pluck('total', 'day');

        $uniqueCounts = VisitorEvent::query()
            ->selectRaw('DATE(visited_at) as day')
            ->selectRaw('COUNT(DISTINCT CONCAT(COALESCE(ip_address, ""), "|", COALESCE(user_agent, ""))) as unique_count')
            ->whereBetween('visited_at', [$start, $end])
            ->groupBy('day')
            ->pluck('unique_count', 'day');

        $cursor = $start->copy()->startOfDay();
        $lastDay = $end->copy()->startOfDay();

        while ($cursor->lessThanOrEqualTo($lastDay)) {
            $key = $cursor->toDateString();
            $labels[] = $cursor->format('M d');
            $pageViews[] = (int) ($counts[$key] ?? 0);
            $visitors[] = (int) ($counts[$key] ?? 0);
            $unique[] = (int) ($uniqueCounts[$key] ?? 0);
            $cursor->addDay();
        }

        return [
            'labels' => $labels,
            'visitors' => $visitors,
            'unique' => $unique,
            'pageViews' => $pageViews,
        ];
    }

    private function humanizeUrl(string $url): string
    {
        if ($url === '/' || $url === '') {
            return 'Homepage';
        }

        $segments = array_filter(explode('/', trim($url, '/')));
        $last = end($segments) ?: 'page';

        return str($last)
            ->replace('-', ' ')
            ->replace('_', ' ')
            ->title()
            ->value();
    }

    private function countryCodeToFlag(string $countryCode): string
    {
        $code = strtoupper(trim($countryCode));

        if (strlen($code) !== 2 || ! ctype_alpha($code)) {
            return '🏳️';
        }

        $base = 127397;

        return mb_chr($base + ord($code[0])).mb_chr($base + ord($code[1]));
    }
}
