@extends('layouts.dashboard')

@section('title', 'Dashboard · Visitor Analytics')
@section('page-heading', 'Dashboard Overview')

@section('content')
    <div class="space-y-6">
        <div class="flex flex-col gap-4 rounded-xl border border-slate-800 bg-slate-900/80 p-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-lg font-semibold text-white">Site Visitor Analytics</h2>
                <p class="text-sm text-slate-400">Live overview of visitor behavior and traffic performance.</p>
            </div>

            <form method="GET" action="{{ route('dashboard') }}" class="flex flex-wrap gap-2">
                @foreach(['today' => 'Today', '7d' => 'Last 7 Days', '30d' => 'Last 30 Days'] as $value => $label)
                    <button
                        type="submit"
                        name="period"
                        value="{{ $value }}"
                        class="rounded-md border px-3 py-1.5 text-xs font-medium transition {{ $period === $value ? 'border-sky-400/50 bg-sky-500/15 text-sky-200' : 'border-slate-700 text-slate-300 hover:border-slate-500 hover:text-white' }}"
                    >
                        {{ $label }}
                    </button>
                @endforeach
            </form>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
            @foreach($stats as $stat)
                <x-dashboard.card>
                    <div class="space-y-3">
                        <p class="text-xs uppercase tracking-[0.12em] text-slate-400">{{ $stat['label'] }}</p>
                        <p class="text-3xl font-semibold text-white">{{ $stat['value'] }}</p>
                        <div class="flex items-center justify-between text-xs">
                            <span class="inline-flex items-center gap-1 rounded-full px-2 py-1 {{ $stat['trendUp'] ? 'bg-emerald-500/15 text-emerald-300' : 'bg-rose-500/15 text-rose-300' }}">
                                {{ $stat['trendUp'] ? '↗' : '↘' }} {{ $stat['trend'] }}
                            </span>
                            <span class="text-slate-400">{{ $stat['subtitle'] }}</span>
                        </div>
                    </div>
                </x-dashboard.card>
            @endforeach
        </div>

        <div class="grid gap-6 xl:grid-cols-3">
            <x-dashboard.card title="Visitors Over Time" subtitle="Daily trend for visitors, unique visitors, and page views" class="xl:col-span-2">
                <canvas id="visitorTrendChart" height="120"></canvas>
            </x-dashboard.card>

            <x-dashboard.card title="Traffic Sources" subtitle="Distribution by acquisition channel">
                <canvas id="trafficSourcesChart" height="220"></canvas>
            </x-dashboard.card>
        </div>

        <div class="grid gap-6 xl:grid-cols-2">
            <x-dashboard.table-wrapper title="Top Pages" subtitle="Most visited URLs and contribution share">
                <table class="min-w-full divide-y divide-slate-800 text-sm">
                    <thead class="bg-slate-900">
                        <tr class="text-left text-xs uppercase tracking-[0.1em] text-slate-400">
                            <th class="px-4 py-3">Page</th>
                            <th class="px-4 py-3 text-right">Views</th>
                            <th class="px-4 py-3 text-right">Share</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800 text-slate-200">
                        @foreach($topPages as $page)
                            <tr class="hover:bg-slate-800/50">
                                <td class="px-4 py-3">
                                    <p class="font-medium text-white">{{ $page['label'] }}</p>
                                    <p class="text-xs text-slate-400">{{ $page['url'] }}</p>
                                </td>
                                <td class="px-4 py-3 text-right font-semibold">{{ number_format($page['views']) }}</td>
                                <td class="px-4 py-3 text-right text-slate-300">{{ number_format($page['percentage'], 1) }}%</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </x-dashboard.table-wrapper>

            <x-dashboard.table-wrapper title="Top Countries" subtitle="Geographic distribution by IP-based traffic">
                <table class="min-w-full divide-y divide-slate-800 text-sm">
                    <thead class="bg-slate-900">
                        <tr class="text-left text-xs uppercase tracking-[0.1em] text-slate-400">
                            <th class="px-4 py-3">Country</th>
                            <th class="px-4 py-3 text-right">Visitors</th>
                            <th class="px-4 py-3 text-right">Share</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800 text-slate-200">
                        @foreach($countries as $country)
                            <tr class="hover:bg-slate-800/50">
                                <td class="px-4 py-3">
                                    <span class="mr-2">{{ $country['flag'] }}</span>{{ $country['country'] }}
                                </td>
                                <td class="px-4 py-3 text-right font-semibold">{{ number_format($country['count']) }}</td>
                                <td class="px-4 py-3 text-right text-slate-300">{{ number_format($country['percentage'], 1) }}%</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </x-dashboard.table-wrapper>
        </div>

        <x-dashboard.table-wrapper title="Recent Visitor Activity" subtitle="Latest tracked requests based on visitor IP data">
            <table class="min-w-full divide-y divide-slate-800 text-sm">
                <thead class="bg-slate-900">
                    <tr class="text-left text-xs uppercase tracking-[0.1em] text-slate-400">
                        <th class="px-4 py-3">IP Address</th>
                        <th class="px-4 py-3">Country</th>
                        <th class="px-4 py-3">URL</th>
                        <th class="px-4 py-3">Referrer</th>
                        <th class="px-4 py-3">Timestamp</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800 text-slate-200">
                    @foreach($recentVisitors as $visitor)
                        <tr class="hover:bg-slate-800/50">
                            <td class="px-4 py-3 font-mono text-xs sm:text-sm">{{ $visitor['ip'] }}</td>
                            <td class="px-4 py-3"><span class="mr-1">{{ $visitor['flag'] }}</span>{{ $visitor['country'] }}</td>
                            <td class="px-4 py-3 text-slate-300">{{ $visitor['url'] }}</td>
                            <td class="px-4 py-3 text-slate-400">{{ $visitor['referrer'] }}</td>
                            <td class="px-4 py-3 text-slate-400">{{ $visitor['visited_at'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-dashboard.table-wrapper>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
    <script>
        const visitorChartData = @json($visitorChartData);
        const trafficSources = @json($trafficSources);

        new Chart(document.getElementById('visitorTrendChart'), {
            type: 'line',
            data: {
                labels: visitorChartData.labels,
                datasets: [
                    {
                        label: 'Visitors',
                        data: visitorChartData.visitors,
                        borderColor: '#38bdf8',
                        backgroundColor: 'rgba(56, 189, 248, 0.12)',
                        tension: 0.35,
                        fill: true,
                    },
                    {
                        label: 'Unique',
                        data: visitorChartData.unique,
                        borderColor: '#818cf8',
                        backgroundColor: 'rgba(129, 140, 248, 0.06)',
                        tension: 0.35,
                        fill: false,
                    },
                    {
                        label: 'Page Views',
                        data: visitorChartData.pageViews,
                        borderColor: '#34d399',
                        backgroundColor: 'rgba(52, 211, 153, 0.05)',
                        tension: 0.35,
                        fill: false,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: { ticks: { color: '#94a3b8' }, grid: { color: 'rgba(148,163,184,0.1)' } },
                    y: { ticks: { color: '#94a3b8' }, grid: { color: 'rgba(148,163,184,0.1)' } },
                },
                plugins: { legend: { labels: { color: '#cbd5e1' } } }
            }
        });

        new Chart(document.getElementById('trafficSourcesChart'), {
            type: 'pie',
            data: {
                labels: trafficSources.map(item => item.source),
                datasets: [{
                    data: trafficSources.map(item => item.count),
                    backgroundColor: ['#38bdf8', '#818cf8', '#34d399', '#f59e0b', '#f43f5e', '#94a3b8'],
                    borderColor: '#0f172a',
                    borderWidth: 2,
                }],
            },
            options: {
                plugins: {
                    legend: { labels: { color: '#cbd5e1' } }
                }
            }
        });
    </script>
@endpush
