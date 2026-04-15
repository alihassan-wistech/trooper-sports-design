@props(['title' => null, 'subtitle' => null])

<x-dashboard.card :title="$title" :subtitle="$subtitle" padding="p-0" {{ $attributes }}>
    <div class="overflow-x-auto">
        {{ $slot }}
    </div>
</x-dashboard.card>
