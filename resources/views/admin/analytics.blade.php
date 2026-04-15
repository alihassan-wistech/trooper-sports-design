@extends('layouts.dashboard')

@section('title', 'Analytics · Visitor Reports')
@section('page-heading', 'Detailed Analytics')

@section('content')
    @php
        $tabs = [
            'overview' => 'Overview',
            'traffic-sources' => 'Traffic Sources',
            'top-pages' => 'Top Pages',
            'geography' => 'Geography',
        ];

        $nextDirection = $direction === 'asc' ? 'desc' : 'asc';
    @endphp

    <div class="space-y-6">
        <x-dashboard.card>
            <form method="GET" action="{{ route('analytics') }}" class="grid gap-4 md:grid-cols-2 xl:grid-cols-5">
                <input type="hidden" name="tab" value="{{ $activeTab }}">
                <div>
                    <label for="start_date" class="mb-1 block text-xs font-medium uppercase tracking-[0.08em] text-slate-400">Start Date</label>
                    <input id="start_date" type="date" name="start_date" value="{{ $startDate }}" class="w-full rounded-md border border-slate-700 bg-slate-950 px-3 py-2 text-sm text-slate-100 focus:border-sky-400 focus:ring-sky-400">
                </div>
                <div>
                    <label for="end_date" class="mb-1 block text-xs font-medium uppercase tracking-[0.08em] text-slate-400">End Date</label>
                    <input id="end_date" type="date" name="end_date" value="{{ $endDate }}" class="w-full rounded-md border border-slate-700 bg-slate-950 px-3 py-2 text-sm text-slate-100 focus:border-sky-400 focus:ring-sky-400">
                </div>
                <div class="xl:col-span-2">
                    <label for="search" class="mb-1 block text-xs font-medium uppercase tracking-[0.08em] text-slate-400">Search</label>
                    <input id="search" type="text" name="search" value="{{ $search }}" placeholder="Search by URL, country, referrer, or IP" class="w-full rounded-md border border-slate-700 bg-slate-950 px-3 py-2 text-sm text-slate-100 placeholder:text-slate-500 focus:border-sky-400 focus:ring-sky-400">
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit" class="w-full rounded-md bg-sky-500 px-4 py-2 text-sm font-semibold text-slate-950 transition hover:bg-sky-400">Apply Filters</button>
                </div>
            </form>
        </x-dashboard.card>

        <div class="flex flex-wrap gap-2">
            @foreach($tabs as $tabKey => $tabLabel)
                <a
                    href="{{ route('analytics', array_merge(request()->except('tab'), ['tab' => $tabKey])) }}"
                    class="rounded-md border px-3 py-1.5 text-xs font-medium transition {{ $activeTab === $tabKey ? 'border-sky-400/50 bg-sky-500/15 text-sky-200' : 'border-slate-700 text-slate-300 hover:border-slate-500 hover:text-white' }}"
                >
                    {{ $tabLabel }}
                </a>
            @endforeach
        </div>

        @if($activeTab === 'overview')
            <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                @foreach(array_slice($stats, 0, 4) as $stat)
                    <x-dashboard.card>
                        <p class="text-xs uppercase tracking-[0.1em] text-slate-400">{{ $stat['label'] }}</p>
                        <p class="mt-2 text-2xl font-semibold text-white">{{ $stat['value'] }}</p>
                        <p class="mt-2 text-xs {{ $stat['trendUp'] ? 'text-emerald-300' : 'text-rose-300' }}">{{ $stat['trend'] }} {{ $stat['subtitle'] }}</p>
                    </x-dashboard.card>
                @endforeach
            </div>

            <x-dashboard.card title="Visitors vs Page Views" subtitle="Daily traffic trends in selected range">
                <canvas id="analyticsOverviewChart" height="120"></canvas>
            </x-dashboard.card>
        @endif

        @if($activeTab === 'traffic-sources' || $activeTab === 'overview')
            <div class="grid gap-6 xl:grid-cols-5">
                <x-dashboard.table-wrapper title="Traffic Sources" subtitle="Where your visitors are coming from" class="xl:col-span-3">
                    <table class="min-w-full divide-y divide-slate-800 text-sm">
                        <thead class="bg-slate-900">
                        <tr class="text-left text-xs uppercase tracking-[0.1em] text-slate-400">
                            <th class="px-4 py-3">Source</th>
                            <th class="px-4 py-3 text-right">Count</th>
                            <th class="px-4 py-3 text-right">Share</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800 text-slate-200">
                        @foreach($trafficSources as $source)
                            <tr class="hover:bg-slate-800/50">
                                <td class="px-4 py-3 font-medium text-white">{{ $source['source'] }}</td>
                                <td class="px-4 py-3 text-right">{{ number_format($source['count']) }}</td>
                                <td class="px-4 py-3 text-right">{{ number_format($source['percentage'], 1) }}%</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </x-dashboard.table-wrapper>

                <x-dashboard.card title="Source Mix" subtitle="Channel distribution" class="xl:col-span-2">
                    <canvas id="analyticsTrafficPie" height="220"></canvas>
                </x-dashboard.card>
            </div>
        @endif

        @if($activeTab === 'top-pages' || $activeTab === 'overview')
            <x-dashboard.table-wrapper title="Top Pages" subtitle="Sortable page performance table">
                <table class="min-w-full divide-y divide-slate-800 text-sm">
                    <thead class="bg-slate-900">
                    <tr class="text-left text-xs uppercase tracking-[0.1em] text-slate-400">
                        <th class="px-4 py-3">
                            <a href="{{ route('analytics', array_merge(request()->except('sort', 'direction'), ['tab' => $activeTab, 'sort' => 'url', 'direction' => $nextDirection])) }}" class="inline-flex items-center gap-1 hover:text-white">
                                URL
                                @if($sort === 'url')<span>{{ $direction === 'asc' ? '↑' : '↓' }}</span>@endif
                            </a>
                        </th>
                        <th class="px-4 py-3 text-right">
                            <a href="{{ route('analytics', array_merge(request()->except('sort', 'direction'), ['tab' => $activeTab, 'sort' => 'views', 'direction' => $nextDirection])) }}" class="inline-flex items-center gap-1 hover:text-white">
                                Views
                                @if($sort === 'views')<span>{{ $direction === 'asc' ? '↑' : '↓' }}</span>@endif
                            </a>
                        </th>
                        <th class="px-4 py-3 text-right">
                            <a href="{{ route('analytics', array_merge(request()->except('sort', 'direction'), ['tab' => $activeTab, 'sort' => 'percentage', 'direction' => $nextDirection])) }}" class="inline-flex items-center gap-1 hover:text-white">
                                Share
                                @if($sort === 'percentage')<span>{{ $direction === 'asc' ? '↑' : '↓' }}</span>@endif
                            </a>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800 text-slate-200">
                    @forelse($topPages as $page)
                        <tr class="hover:bg-slate-800/50">
                            <td class="px-4 py-3">
                                <p class="font-medium text-white">{{ $page['label'] }}</p>
                                <p class="text-xs text-slate-400">{{ $page['url'] }}</p>
                            </td>
                            <td class="px-4 py-3 text-right">{{ number_format($page['views']) }}</td>
                            <td class="px-4 py-3 text-right">{{ number_format($page['percentage'], 1) }}%</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-6 text-center text-slate-400">No pages match your search.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </x-dashboard.table-wrapper>
        @endif

        @if($activeTab === 'geography' || $activeTab === 'overview')
            <div class="grid gap-6 xl:grid-cols-2">
                <x-dashboard.table-wrapper title="Countries" subtitle="Visitor geography by IP">
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
                                <td class="px-4 py-3"><span class="mr-2">{{ $country['flag'] }}</span>{{ $country['country'] }}</td>
                                <td class="px-4 py-3 text-right">{{ number_format($country['count']) }}</td>
                                <td class="px-4 py-3 text-right">{{ number_format($country['percentage'], 1) }}%</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </x-dashboard.table-wrapper>

                <x-dashboard.table-wrapper title="Recent Visitors" subtitle="Server-rendered and searchable activity stream">
                    <table class="min-w-full divide-y divide-slate-800 text-sm">
                        <thead class="bg-slate-900">
                        <tr class="text-left text-xs uppercase tracking-[0.1em] text-slate-400">
                            <th class="px-4 py-3">IP</th>
                            <th class="px-4 py-3">Country</th>
                            <th class="px-4 py-3">URL</th>
                            <th class="px-4 py-3">Referrer</th>
                            <th class="px-4 py-3">Time</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800 text-slate-200">
                        @forelse($recentVisitors->take(12) as $visitor)
                            <tr class="hover:bg-slate-800/50">
                                <td class="px-4 py-3 font-mono text-xs">{{ $visitor['ip'] }}</td>
                                <td class="px-4 py-3"><span class="mr-1">{{ $visitor['flag'] }}</span>{{ $visitor['country'] }}</td>
                                <td class="px-4 py-3">{{ $visitor['url'] }}</td>
                                <td class="px-4 py-3 text-slate-400">{{ $visitor['referrer'] }}</td>
                                <td class="px-4 py-3 text-slate-400">{{ $visitor['visited_at'] }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-6 text-center text-slate-400">No visitor records match your filters.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </x-dashboard.table-wrapper>
            </div>
        @endif

        <div class="grid gap-6 xl:grid-cols-2">
            <x-dashboard.card title="Visitors Line Chart" subtitle="Trend line for reporting">
                <canvas id="analyticsLineChart" height="120"></canvas>
            </x-dashboard.card>

            <x-dashboard.card title="Top Pages Bar Chart" subtitle="Quick visual ranking">
                <canvas id="analyticsBarChart" height="120"></canvas>
            </x-dashboard.card>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
    <script>
        const visitorChartData = @json($visitorChartData);
        const topPages = @json($topPages->take(6)->values());
        const trafficSources = @json($trafficSources);
        const overviewChartEl = document.getElementById('analyticsOverviewChart');
        if (overviewChartEl) {
            new Chart(overviewChartEl, {
                type: 'line',
                data: {
                    labels: visitorChartData.labels,
                    datasets: [
                        {
                            label: 'Visitors',
                            data: visitorChartData.visitors,
                            borderColor: '#38bdf8',
                            backgroundColor: 'rgba(56, 189, 248, 0.10)',
                            fill: true,
                            tension: 0.3,
                        },
                        {
                            label: 'Page Views',
                            data: visitorChartData.pageViews,
                            borderColor: '#34d399',
                            backgroundColor: 'rgba(52, 211, 153, 0.04)',
                            fill: false,
                            tension: 0.3,
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
        }

        const lineChartEl = document.getElementById('analyticsLineChart');
        if (lineChartEl) {
            new Chart(lineChartEl, {
                type: 'line',
                data: {
                    labels: visitorChartData.labels,
                    datasets: [{
                        label: 'Unique Visitors',
                        data: visitorChartData.unique,
                        borderColor: '#818cf8',
                        backgroundColor: 'rgba(129, 140, 248, 0.08)',
                        fill: true,
                        tension: 0.35,
                    }]
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
        }

        const barChartEl = document.getElementById('analyticsBarChart');
        if (barChartEl) {
            new Chart(barChartEl, {
                type: 'bar',
                data: {
                    labels: topPages.map(page => page.label),
                    datasets: [{
                        label: 'Views',
                        data: topPages.map(page => page.views),
                        backgroundColor: '#38bdf8',
                        borderRadius: 6,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: { ticks: { color: '#94a3b8' }, grid: { display: false } },
                        y: { ticks: { color: '#94a3b8' }, grid: { color: 'rgba(148,163,184,0.1)' } },
                    },
                    plugins: { legend: { labels: { color: '#cbd5e1' } } }
                }
            });
        }

        const pieChartEl = document.getElementById('analyticsTrafficPie');
        if (pieChartEl) {
            new Chart(pieChartEl, {
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
        }
    </script>
@endpush
