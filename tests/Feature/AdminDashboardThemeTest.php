<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\ViewErrorBag;
use Tests\TestCase;

class AdminDashboardThemeTest extends TestCase
{
    public function test_admin_views_use_light_dashboard_content_theme(): void
    {
        $this->actingAs(User::factory()->make(['name' => 'Admin User']));
        view()->share('errors', new ViewErrorBag);

        foreach ($this->adminViewPayloads() as $view => $payload) {
            $html = view($view, $payload)->render();

            $this->assertStringContainsString('bg-white', $html);
            $this->assertStringContainsString('border-neutral-200', $html);
            $this->assertStringContainsString('text-neutral-950', $html);
            $this->assertStringNotContainsString('bg-neutral-900/80', $html);
            $this->assertStringNotContainsString('divide-neutral-800', $html);
            $this->assertStringNotContainsString('sky-', $html);
            $this->assertStringNotContainsString('emerald-', $html);
            $this->assertStringNotContainsString('rose-', $html);
            $this->assertStringNotContainsString('indigo-', $html);
            $this->assertStringNotContainsString('bg-slate', $html);
            $this->assertStringNotContainsString('text-slate', $html);
            $this->assertStringNotContainsString('border-slate', $html);
        }
    }

    public function test_dashboard_sidebar_remains_dark(): void
    {
        $html = view('components.dashboard.sidebar')->render();

        $this->assertStringContainsString('bg-neutral-900/95', $html);
        $this->assertStringContainsString('border-neutral-800', $html);
        $this->assertStringContainsString('text-white', $html);
    }

    public function test_dashboard_layout_uses_light_main_shell(): void
    {
        $this->actingAs(User::factory()->make(['name' => 'Admin User']));

        $html = (string) $this->blade(<<<'BLADE'
            @extends('layouts.dashboard')
            @section('page-heading', 'Sample')
            @section('content')
                <x-dashboard.card title="Sample">Body</x-dashboard.card>
            @endsection
        BLADE);

        $this->assertStringContainsString('<body class="bg-neutral-100 text-neutral-950 antialiased">', $html);
        $this->assertStringContainsString('border-b border-neutral-200 bg-white/95', $html);
        $this->assertStringContainsString('bg-neutral-900/95', $html);
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    private function adminViewPayloads(): array
    {
        return [
            'admin.dashboard' => $this->analyticsPayload() + [
                'period' => '7d',
                'topPages' => $this->topPages(),
                'countries' => $this->countries(),
                'recentVisitors' => $this->recentVisitors(),
            ],
            'admin.analytics' => $this->analyticsPayload() + [
                'activeTab' => 'overview',
                'startDate' => now()->subDays(6)->toDateString(),
                'endDate' => now()->toDateString(),
                'search' => '',
                'sort' => 'views',
                'direction' => 'desc',
                'topPages' => $this->topPages(),
                'countries' => $this->countries(),
                'recentVisitors' => $this->recentVisitors(),
            ],
            'admin.seo-settings' => [
                'pages' => collect([
                    (object) [
                        'page_key' => 'home',
                        'page_name' => 'Homepage',
                        'meta_title' => 'Home',
                        'meta_description' => 'Homepage meta description',
                        'schema_json' => null,
                    ],
                ]),
                'scripts' => (object) [
                    'header_scripts' => null,
                    'footer_scripts' => null,
                ],
            ],
            'admin.categories.index' => [
                'categories' => collect([
                    Category::factory()->make([
                        'name' => 'Custom Team Uniforms',
                        'slug' => 'team-uniforms',
                        'card_label' => 'Team Wear',
                        'sort_order' => 1,
                        'is_published' => true,
                    ]),
                ]),
            ],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private function analyticsPayload(): array
    {
        return [
            'stats' => [
                ['label' => 'Total Visitors', 'value' => '120', 'trendUp' => true, 'trend' => '+12%', 'subtitle' => 'vs previous period'],
                ['label' => 'Page Views', 'value' => '340', 'trendUp' => false, 'trend' => '-3%', 'subtitle' => 'all tracked pages'],
            ],
            'trafficSources' => collect([
                ['source' => 'Direct', 'count' => 80, 'percentage' => 66.7],
                ['source' => 'Search', 'count' => 40, 'percentage' => 33.3],
            ]),
            'visitorChartData' => [
                'labels' => ['Mon', 'Tue'],
                'visitors' => [40, 80],
                'unique' => [30, 60],
                'pageViews' => [120, 220],
            ],
        ];
    }

    private function topPages(): Collection
    {
        return collect([
            ['label' => 'Home', 'url' => '/', 'views' => 120, 'percentage' => 60.0],
            ['label' => 'Contact', 'url' => '/contact', 'views' => 80, 'percentage' => 40.0],
        ]);
    }

    private function countries(): Collection
    {
        return collect([
            ['flag' => 'PK', 'country' => 'Pakistan', 'count' => 75, 'percentage' => 62.5],
            ['flag' => 'US', 'country' => 'United States', 'count' => 45, 'percentage' => 37.5],
        ]);
    }

    private function recentVisitors(): Collection
    {
        return collect([
            [
                'ip' => '127.0.0.1',
                'flag' => 'PK',
                'country' => 'Pakistan',
                'url' => '/',
                'referrer' => 'Direct',
                'source' => 'Direct',
                'visited_at' => now()->toDateTimeString(),
            ],
        ]);
    }
}
