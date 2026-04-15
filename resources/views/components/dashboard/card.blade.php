@props(['title' => null, 'subtitle' => null, 'padding' => 'p-5'])

<section {{ $attributes->merge(['class' => 'rounded-xl border border-slate-800 bg-slate-900/80 shadow-sm']) }}>
    @if($title)
        <header class="border-b border-slate-800 px-5 py-4">
            <h3 class="text-sm font-semibold text-white">{{ $title }}</h3>
            @if($subtitle)
                <p class="mt-1 text-xs text-slate-400">{{ $subtitle }}</p>
            @endif
        </header>
    @endif

    <div class="{{ $padding }}">
        {{ $slot }}
    </div>
</section>
