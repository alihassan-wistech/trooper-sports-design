@props(['href', 'active' => false])

@php
$classes = $active
    ? 'border border-neutral-500 bg-white text-black'
    : 'border border-transparent text-neutral-300 hover:bg-neutral-800/70 hover:text-white';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => 'group flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium transition ' . $classes]) }}>
    @isset($icon)
        <span class="{{ $active ? 'text-black' : 'text-neutral-400 group-hover:text-neutral-200' }}">{{ $icon }}</span>
    @endisset
    <span>{{ $slot }}</span>
</a>
