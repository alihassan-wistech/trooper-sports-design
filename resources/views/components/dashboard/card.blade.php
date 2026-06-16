@props(['title' => null, 'subtitle' => null, 'padding' => 'p-5'])

<section {{ $attributes->merge(['class' => 'rounded-xl border border-neutral-200 bg-white shadow-sm']) }}>
    @if($title)
        <header class="border-b border-neutral-200 px-5 py-4">
            <h3 class="text-sm font-semibold text-neutral-950">{{ $title }}</h3>
            @if($subtitle)
                <p class="mt-1 text-xs text-neutral-500">{{ $subtitle }}</p>
            @endif
        </header>
    @endif

    <div class="{{ $padding }}">
        {{ $slot }}
    </div>
</section>
