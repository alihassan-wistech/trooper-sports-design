@extends('frontend.layouts.app')

@section('title', $category->title.' - Troopers Sports')

@section('content')
    @php
        $assetUrl = function (?string $path, string $fallback = 'images/hero-slider/01.jpeg'): string {
            $path = $path ?: $fallback;

            return str_starts_with($path, 'http') ? $path : asset($path);
        };

        $stats = $category->stats ?: [];
        $overviewParagraphs = $category->overview_paragraphs ?: [];
        $bestFitItems = $category->best_fit_items ?: [];
        $subCategories = $category->subcategories ?: [];
        $galleryProducts = $category->gallery_products ?: [];
    @endphp

    <section
        class="relative overflow-hidden border-b border-black bg-neutral-dark py-24 text-white lg:py-28"
        style="background-image: linear-gradient(100deg, rgba(0, 0, 0, 0.9) 0%, rgba(0, 0, 0, 0.7) 42%, rgba(0, 0, 0, 0.18) 100%), url('{{ $assetUrl($category->hero_image) }}'); background-size: cover; background-position: center;"
    >
        <div class="max-w-[1440px] mx-auto px-6 lg:px-12 relative z-10">
            <span class="inline-flex border border-white px-4 py-2 text-sm font-bold uppercase tracking-[0.18em] text-gray-300">
                {{ $category->hero_badge }}
            </span>
            <h1 class="mt-6 max-w-5xl font-heading text-5xl font-extrabold uppercase leading-[1.02] tracking-[-0.03em] md:text-6xl lg:text-7xl">
                {{ $category->hero_title }}
                @if ($category->hero_highlight)
                    <span class="text-gray-300">{{ $category->hero_highlight }}</span>
                @endif
            </h1>
            <p class="mt-6 max-w-3xl text-lg font-medium leading-[1.5] text-gray-300 md:text-xl">
                {{ $category->hero_description }}
            </p>
            <div class="mt-10 flex flex-col gap-4 sm:flex-row">
                <a href="{{ route('contact') }}" class="btn btn-light btn-md">
                    REQUEST BULK QUOTE
                </a>
                <a href="https://wa.me/923418649479" class="btn btn-outline-light btn-md">
                    CHAT ON WHATSAPP
                </a>
            </div>
        </div>
    </section>

    @if ($stats !== [])
        <section class="border-b border-black bg-white py-12 shadow-sm">
            <div class="max-w-[1440px] mx-auto px-6 lg:px-12">
                <div class="grid grid-cols-2 gap-6 text-center md:grid-cols-4 divide-x divide-black">
                    @foreach ($stats as $stat)
                        <div class="flex flex-col items-center justify-center p-2">
                            <span class="font-heading text-4xl text-dark md:text-5xl">{{ $stat['value'] ?? '' }}</span>
                            <span class="text-[14px] font-bold uppercase tracking-[0.05em] text-neutral-dark">{{ $stat['label'] ?? '' }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="border-b border-black bg-light py-20 lg:py-24">
        <div class="max-w-[1440px] mx-auto px-6 lg:px-12">
            <div class="grid grid-cols-1 gap-12 lg:grid-cols-[1.1fr_0.9fr] lg:gap-16">
                <div>
                    <p class="text-[14px] font-semibold uppercase tracking-[0.12em] text-neutral-dark">{{ $category->overview_eyebrow }}</p>
                    <h2 class="mt-3 font-heading text-4xl font-bold leading-[1.1] tracking-[-0.02em] text-dark md:text-[52px]">
                        {{ $category->overview_title }}
                    </h2>
                    <div class="mt-6 space-y-5 text-[18px] leading-relaxed text-neutral-dark">
                        @foreach ($overviewParagraphs as $paragraph)
                            <p>{{ $paragraph }}</p>
                        @endforeach
                    </div>
                </div>

                <div class="border border-black bg-white p-8 lg:p-10">
                    <p class="text-[14px] font-semibold uppercase tracking-[0.12em] text-neutral-dark">{{ $category->best_fit_eyebrow }}</p>
                    <div class="mt-6 grid grid-cols-1 gap-4">
                        @foreach ($bestFitItems as $item)
                            <div class="border border-black bg-light p-5">
                                <h3 class="text-[20px] font-semibold text-dark">{{ $item['title'] ?? '' }}</h3>
                                <p class="mt-2 text-[16px] leading-relaxed text-neutral-dark">{{ $item['description'] ?? '' }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="border-b border-black bg-white py-20 lg:py-24">
        <div class="max-w-[1440px] mx-auto px-6 lg:px-12">
            <div class="grid grid-cols-1 gap-10 lg:grid-cols-[0.85fr_1.15fr] lg:items-end">
                <div class="max-w-3xl">
                    <h2 class="mt-3 font-heading text-4xl font-bold leading-[1.1] tracking-[-0.02em] text-dark md:text-[48px]">
                        {{ $category->subcategory_title }}
                    </h2>
                    <p class="mt-4 text-[18px] leading-relaxed text-neutral-dark">
                        {{ $category->subcategory_description }}
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-4 md:grid-cols-3">
                    @foreach ($subCategories as $index => $subCategory)
                        <div class="border border-black bg-light px-4 py-5">
                            <p class="text-[12px] font-bold uppercase tracking-[0.16em] text-neutral-dark">
                                {{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}
                            </p>
                            <p class="mt-2 text-[15px] font-semibold leading-snug text-dark">
                                {{ $subCategory['title'] ?? '' }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mt-12 grid grid-cols-1 gap-8 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($subCategories as $subCategory)
                    <article class="group border border-black bg-light p-8 transition-all duration-300 hover:bg-dark">
                        <h3 class="text-[24px] font-semibold leading-tight text-dark transition-colors group-hover:text-white">
                            {{ $subCategory['title'] ?? '' }}
                        </h3>
                        <p class="mt-4 text-[17px] leading-relaxed text-neutral-dark transition-colors group-hover:text-gray-300">
                            {{ $subCategory['description'] ?? '' }}
                        </p>
                        <p class="mt-6 border-t border-black pt-4 text-[14px] font-semibold uppercase tracking-[0.08em] text-neutral-dark transition-colors group-hover:border-white group-hover:text-gray-300">
                            {{ $subCategory['details'] ?? '' }}
                        </p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="border-b border-black bg-light py-20 lg:py-24">
        <div class="max-w-[1440px] mx-auto px-6 lg:px-12">
            <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
                <div class="max-w-3xl">
                    <p class="text-[14px] font-semibold uppercase tracking-[0.12em] text-neutral-dark">{{ $category->gallery_eyebrow }}</p>
                    <h2 class="mt-3 font-heading text-4xl font-bold leading-[1.1] tracking-[-0.02em] text-dark md:text-[48px]">
                        {{ $category->gallery_title }}
                    </h2>
                    <p class="mt-4 text-[18px] leading-relaxed text-neutral-dark">
                        {{ $category->gallery_description }}
                    </p>
                </div>
                <a href="{{ route('contact') }}" class="btn btn-outline-dark btn-md shrink-0">
                    ASK ABOUT THIS CATEGORY
                </a>
            </div>

            <div
                x-data="{
                    isLightboxOpen: false,
                    activeProductIndex: 0,
                    productCount: {{ count($galleryProducts) }},
                    openLightbox(index) {
                        this.activeProductIndex = index;
                        this.isLightboxOpen = true;
                        document.body.classList.add('overflow-hidden');
                    },
                    closeLightbox() {
                        this.isLightboxOpen = false;
                        document.body.classList.remove('overflow-hidden');
                    },
                    showNextProduct() {
                        this.activeProductIndex = (this.activeProductIndex + 1) % this.productCount;
                    },
                    showPreviousProduct() {
                        this.activeProductIndex = (this.activeProductIndex + this.productCount - 1) % this.productCount;
                    },
                }"
                x-on:keydown.escape.window="isLightboxOpen && closeLightbox()"
                x-on:keydown.arrow-right.window="isLightboxOpen && showNextProduct()"
                x-on:keydown.arrow-left.window="isLightboxOpen && showPreviousProduct()"
            >
                <div class="mt-12 grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
                    @foreach ($galleryProducts as $index => $galleryProduct)
                        <button
                            type="button"
                            class="group block w-full overflow-hidden border border-black bg-white text-left transition-colors duration-300 hover:bg-dark focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-4"
                            aria-label="Open {{ $galleryProduct['name'] ?? 'product' }} gallery image"
                            x-on:click="openLightbox({{ $index }})"
                        >
                            <span class="block aspect-[4/3] overflow-hidden bg-neutral-dark">
                                <img
                                    src="{{ $assetUrl($galleryProduct['image'] ?? null) }}"
                                    alt="{{ $galleryProduct['name'] ?? $category->name }}"
                                    class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                                    loading="lazy"
                                >
                            </span>
                            <span class="block border-t border-black bg-white p-5 transition-colors duration-300 group-hover:bg-dark group-hover:border-white">
                                <span class="block text-[16px] font-semibold uppercase tracking-[0.12em] text-dark transition-colors group-hover:text-white">
                                    {{ $galleryProduct['name'] ?? '' }}
                                </span>
                            </span>
                        </button>
                    @endforeach
                </div>

                <div
                    id="product-gallery-lightbox"
                    class="fixed inset-0 z-[80] hidden items-center justify-center bg-black/90 p-4 text-white"
                    role="dialog"
                    aria-modal="true"
                    aria-label="Product image gallery"
                    x-bind:class="{ 'hidden': !isLightboxOpen, 'flex': isLightboxOpen }"
                    x-on:click.self="closeLightbox()"
                >
                    <div class="relative flex max-h-[92vh] w-full max-w-6xl flex-col border border-white bg-black">
                        <div class="flex items-center justify-between gap-4 border-b border-white px-4 py-3 sm:px-6">
                            @foreach ($galleryProducts as $index => $galleryProduct)
                                <p
                                    class="text-[14px] font-semibold uppercase tracking-[0.12em] text-white sm:text-[18px]"
                                    x-show="activeProductIndex === {{ $index }}"
                                >
                                    {{ $galleryProduct['name'] ?? '' }}
                                </p>
                            @endforeach

                            <button
                                type="button"
                                class="shrink-0 border border-white px-3 py-2 text-[13px] font-bold uppercase tracking-[0.08em] text-white transition-colors hover:bg-white hover:text-black focus:outline-none focus:ring-2 focus:ring-white"
                                aria-label="Close product gallery"
                                x-on:click="closeLightbox()"
                            >
                                Close
                            </button>
                        </div>

                        <div class="relative flex min-h-0 flex-1 items-center justify-center bg-neutral-dark">
                            @foreach ($galleryProducts as $index => $galleryProduct)
                                <figure
                                    class="w-full"
                                    x-show="activeProductIndex === {{ $index }}"
                                    x-transition.opacity
                                >
                                    <img
                                        src="{{ $assetUrl($galleryProduct['image'] ?? null) }}"
                                        alt="{{ $galleryProduct['name'] ?? $category->name }}"
                                        class="mx-auto max-h-[72vh] w-full object-contain"
                                    >
                                </figure>
                            @endforeach

                            <button
                                type="button"
                                class="absolute left-3 top-1/2 flex h-11 w-11 -translate-y-1/2 items-center justify-center border border-white bg-black/80 text-3xl leading-none text-white transition-colors hover:bg-white hover:text-black focus:outline-none focus:ring-2 focus:ring-white"
                                aria-label="Show previous product image"
                                x-on:click="showPreviousProduct()"
                            >
                                &lsaquo;
                            </button>
                            <button
                                type="button"
                                class="absolute right-3 top-1/2 flex h-11 w-11 -translate-y-1/2 items-center justify-center border border-white bg-black/80 text-3xl leading-none text-white transition-colors hover:bg-white hover:text-black focus:outline-none focus:ring-2 focus:ring-white"
                                aria-label="Show next product image"
                                x-on:click="showNextProduct()"
                            >
                                &rsaquo;
                            </button>
                        </div>

                        <div class="border-t border-white px-4 py-3 text-center text-[13px] font-semibold uppercase tracking-[0.12em] text-gray-300 sm:px-6">
                            <span x-text="activeProductIndex + 1"></span> / {{ count($galleryProducts) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-black py-20 text-white">
        <div class="max-w-[1440px] mx-auto px-6 lg:px-12">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-[1.2fr_0.8fr] lg:items-center">
                <div>
                    <p class="text-[14px] font-semibold uppercase tracking-[0.12em] text-gray-300">{{ $category->inquiry_eyebrow }}</p>
                    <h2 class="mt-3 font-heading text-4xl font-bold uppercase leading-[1.05] tracking-[-0.02em] md:text-[52px]">
                        {{ $category->inquiry_title }}
                    </h2>
                    <p class="mt-5 max-w-3xl text-[18px] leading-relaxed text-gray-300">
                        {{ $category->inquiry_description }}
                    </p>
                </div>
                <div class="flex flex-col gap-4 lg:items-end">
                    <a href="{{ route('contact') }}" class="btn btn-light btn-md w-full justify-center lg:w-auto">
                        {{ strtoupper($category->quote_button_label) }}
                    </a>
                    <a href="https://wa.me/923418649479" class="btn btn-outline-light btn-md w-full justify-center lg:w-auto">
                        {{ strtoupper($category->whatsapp_button_label) }}
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
