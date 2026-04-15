@props(['href', 'active' => false])

@php
$classes = $active
    ? 'bg-sky-500/15 text-sky-200 border border-sky-400/30'
    : 'text-slate-300 hover:bg-slate-800/70 hover:text-white border border-transparent';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => 'group flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium transition ' . $classes]) }}>
    @isset($icon)
        <span class="text-slate-400 group-hover:text-slate-200 {{ $active ? 'text-sky-300' : '' }}">{{ $icon }}</span>
    @endisset
    <span>{{ $slot }}</span>
</a>
