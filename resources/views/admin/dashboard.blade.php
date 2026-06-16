@extends('layouts.dashboard')

@section('title', 'Dashboard · Visitor Analytics')
@section('page-heading', 'Dashboard Overview')

@section('content')
    <div class="space-y-6">
        <div class="flex flex-col gap-4 rounded-xl border border-neutral-200 bg-white p-4 shadow-sm sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-lg font-semibold text-neutral-950">Site Visitor Analytics</h2>
                <p class="text-sm text-neutral-500">Live overview of visitor behavior and traffic performance.</p>
            </div>

            <form method="GET" action="{{ route('dashboard') }}" class="flex flex-wrap gap-2">
                @foreach(['today' => 'Today', '7d' => 'Last 7 Days', '30d' => 'Last 30 Days'] as $value => $label)
                    <button
                        type="submit"
                        name="period"
                        value="{{ $value }}"
                        class="rounded-md border px-3 py-1.5 text-xs font-medium transition {{ $period === $value ? 'border-black bg-black text-white' : 'border-neutral-300 text-neutral-700 hover:border-black hover:text-black' }}"
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
                        <p class="text-xs uppercase tracking-[0.12em] text-neutral-500">{{ $stat['label'] }}</p>
                        <p class="text-3xl font-semibold text-neutral-950">{{ $stat['value'] }}</p>
                        <div class="flex items-center justify-between text-xs">
                            <span class="inline-flex items-center gap-1 rounded-full border px-2 py-1 {{ $stat['trendUp'] ? 'border-neutral-300 bg-neutral-100 text-neutral-950' : 'border-neutral-200 bg-white text-neutral-600' }}">
                                {{ $stat['trendUp'] ? '↗' : '↘' }} {{ $stat['trend'] }}
                            </span>
                            <span class="text-neutral-500">{{ $stat['subtitle'] }}</span>
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
                <table class="min-w-full divide-y divide-neutral-200 text-sm">
                    <thead class="bg-neutral-50">
                        <tr class="text-left text-xs uppercase tracking-[0.1em] text-neutral-500">
                            <th class="px-4 py-3">Page</th>
                            <th class="px-4 py-3 text-right">Views</th>
                            <th class="px-4 py-3 text-right">Share</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-200 text-neutral-700">
                        @foreach($topPages as $page)
                            <tr class="hover:bg-neutral-50">
                                <td class="px-4 py-3">
                                    <p class="font-medium text-neutral-950">{{ $page['label'] }}</p>
                                    <p class="text-xs text-neutral-500">{{ $page['url'] }}</p>
                                </td>
                                <td class="px-4 py-3 text-right font-semibold">{{ number_format($page['views']) }}</td>
                                <td class="px-4 py-3 text-right text-neutral-600">{{ number_format($page['percentage'], 1) }}%</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </x-dashboard.table-wrapper>

            <x-dashboard.table-wrapper title="Top Countries" subtitle="Geographic distribution by IP-based traffic">
                <table class="min-w-full divide-y divide-neutral-200 text-sm">
                    <thead class="bg-neutral-50">
                        <tr class="text-left text-xs uppercase tracking-[0.1em] text-neutral-500">
                            <th class="px-4 py-3">Country</th>
                            <th class="px-4 py-3 text-right">Visitors</th>
                            <th class="px-4 py-3 text-right">Share</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-200 text-neutral-700">
                        @foreach($countries as $country)
                            <tr class="hover:bg-neutral-50">
                                <td class="px-4 py-3">
                                    <span class="mr-2">{{ $country['flag'] }}</span>{{ $country['country'] }}
                                </td>
                                <td class="px-4 py-3 text-right font-semibold">{{ number_format($country['count']) }}</td>
                                <td class="px-4 py-3 text-right text-neutral-600">{{ number_format($country['percentage'], 1) }}%</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </x-dashboard.table-wrapper>
        </div>

        <x-dashboard.table-wrapper title="Recent Visitor Activity" subtitle="Latest tracked requests based on visitor IP data">
            <table class="min-w-full divide-y divide-neutral-200 text-sm">
                <thead class="bg-neutral-50">
                    <tr class="text-left text-xs uppercase tracking-[0.1em] text-neutral-500">
                        <th class="px-4 py-3">IP Address</th>
                        <th class="px-4 py-3">Country</th>
                        <th class="px-4 py-3">URL</th>
                        <th class="px-4 py-3">Referrer</th>
                        <th class="px-4 py-3">Timestamp</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-200 text-neutral-700">
                    @foreach($recentVisitors as $visitor)
                        <tr class="hover:bg-neutral-50">
                            <td class="px-4 py-3 font-mono text-xs sm:text-sm">{{ $visitor['ip'] }}</td>
                            <td class="px-4 py-3"><span class="mr-1">{{ $visitor['flag'] }}</span>{{ $visitor['country'] }}</td>
                            <td class="px-4 py-3 text-neutral-600">{{ $visitor['url'] }}</td>
                            <td class="px-4 py-3 text-neutral-500">{{ $visitor['referrer'] }}</td>
                            <td class="px-4 py-3 text-neutral-500">{{ $visitor['visited_at'] }}</td>
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
                        borderColor: '#000000',
                        backgroundColor: 'rgba(0, 0, 0, 0.08)',
                        tension: 0.35,
                        fill: true,
                    },
                    {
                        label: 'Unique',
                        data: visitorChartData.unique,
                        borderColor: '#525252',
                        backgroundColor: 'rgba(82, 82, 82, 0.08)',
                        tension: 0.35,
                        fill: false,
                    },
                    {
                        label: 'Page Views',
                        data: visitorChartData.pageViews,
                        borderColor: '#a3a3a3',
                        backgroundColor: 'rgba(163, 163, 163, 0.08)',
                        tension: 0.35,
                        fill: false,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: { ticks: { color: '#525252' }, grid: { color: 'rgba(212, 212, 212, 0.75)' } },
                    y: { ticks: { color: '#525252' }, grid: { color: 'rgba(212, 212, 212, 0.75)' } },
                },
                plugins: { legend: { labels: { color: '#262626' } } }
            }
        });

        new Chart(document.getElementById('trafficSourcesChart'), {
            type: 'pie',
            data: {
                labels: trafficSources.map(item => item.source),
                datasets: [{
                    data: trafficSources.map(item => item.count),
                    backgroundColor: ['#000000', '#525252', '#737373', '#a3a3a3', '#d4d4d4', '#f5f5f5'],
                    borderColor: '#ffffff',
                    borderWidth: 2,
                }],
            },
            options: {
                plugins: {
                        legend: { labels: { color: '#262626' } }
                }
            }
        });
    </script>
@endpush
