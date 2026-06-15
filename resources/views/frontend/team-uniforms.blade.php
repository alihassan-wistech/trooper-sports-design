@extends('frontend.layouts.app')

@section('title', 'Custom Team Uniforms – Troopers Sports')

@section('content')
    @php
        $subCategories = [
            [
                'title' => 'Basketball',
                'description' => 'Custom basketball uniforms for clubs, academies, school teams, and distributors that need performance sets in bulk.',
                'details' => 'Jerseys, shorts, reversible kits, player names and numbering.',
            ],
            [
                'title' => 'Football',
                'description' => 'American football uniforms and practice apparel produced for structured team programs with consistent sizing and branding control.',
                'details' => 'Game jerseys, practice tops, sideline apparel, sponsor-ready customization.',
            ],
            [
                'title' => 'Baseball',
                'description' => 'Baseball teamwear designed for clubs and suppliers who need custom cuts, durable trims, and repeat-ready production.',
                'details' => 'Button jerseys, pants, training tops, embroidery and twill options.',
            ],
            [
                'title' => 'Softball',
                'description' => 'Softball uniforms built for schools, leagues, and wholesale buyers looking for coordinated team programs.',
                'details' => 'Women’s fits, game uniforms, training pieces, consistent club branding.',
            ],
            [
                'title' => 'Soccer',
                'description' => 'Bulk custom soccer kits manufactured for clubs, academies, tour operators, and private-label teamwear brands.',
                'details' => 'Match kits, training sets, tracksuits, sponsor placements, numbering.',
            ],
            [
                'title' => 'Volleyball',
                'description' => 'Volleyball uniforms developed for indoor and beach team programs with lightweight fabrics and sharp branding execution.',
                'details' => 'Jerseys, shorts, warm-ups, women’s and youth size runs.',
            ],
            [
                'title' => 'Flag Football',
                'description' => 'Flag football apparel made for tournament organizers, clubs, schools, and resellers needing custom team sets in volume.',
                'details' => 'Lightweight jerseys, coordinated shorts, names, numbers, logo applications.',
            ],
            [
                'title' => 'Cheerleading',
                'description' => 'Cheerleading uniforms and team apparel produced for schools, studios, and organizations that need polished visual presentation.',
                'details' => 'Performance sets, warm-ups, layering pieces, team identity branding.',
            ],
            [
                'title' => 'Cricket',
                'description' => 'Cricket uniforms engineered for clubs, schools, and distributors who require clean finishes, reliable reorders, and team customization.',
                'details' => 'Match shirts, trousers, training kits, sponsor branding, size continuity.',
            ],
            [
                'title' => 'Lacrosse',
                'description' => 'Custom lacrosse uniforms built for team programs that need breathable fabrics, durable construction, and flexible design execution.',
                'details' => 'Game jerseys, shorts, pinnies, training layers, numbering systems.',
            ],
            [
                'title' => 'Ice Hockey',
                'description' => 'Ice hockey jerseys and supporting teamwear manufactured for clubs and brands needing bulk custom production with strong visual consistency.',
                'details' => 'Game jerseys, training tops, twill details, sponsor-safe layouts.',
            ],
            [
                'title' => 'Field Hockey',
                'description' => 'Field hockey kits tailored for school and club programs that want coordinated teamwear with repeatable quality.',
                'details' => 'Match uniforms, skorts, shorts, warm-up apparel, custom numbering.',
            ],
            [
                'title' => 'Track',
                'description' => 'Track and athletics teamwear for schools, clubs, and event programs requiring lightweight construction and multi-item package consistency.',
                'details' => 'Singlets, shorts, warm-ups, relay kits, club branding systems.',
            ],
            [
                'title' => 'Rugby',
                'description' => 'Rugby uniforms produced for clubs and retailers needing durable garments, strong seam integrity, and bold team branding.',
                'details' => 'Match jerseys, shorts, training tops, sponsor integration, size grading.',
            ],
            [
                'title' => 'Bowling',
                'description' => 'Custom bowling shirts and team apparel for leagues, clubs, and promotional programs ordering in bulk.',
                'details' => 'Button shirts, polos, sublimation artwork, team and sponsor identities.',
            ],
            [
                'title' => 'Wrestling',
                'description' => 'Wrestling teamwear programs built for schools, academies, and clubs that need consistent fit and competition-ready output.',
                'details' => 'Singlets, warm-up suits, compression layers, custom club branding.',
            ],
            [
                'title' => 'Cycling',
                'description' => 'Cycling apparel manufactured for clubs, event teams, and brand programs that need technical garments in bulk.',
                'details' => 'Jerseys, bib shorts, gilets, race-day graphics, coordinated collections.',
            ],
            [
                'title' => 'Tennis',
                'description' => 'Tennis team apparel created for academies, clubs, and tournament programs seeking polished customization and dependable repeat orders.',
                'details' => 'Match polos, skirts, shorts, warm-up layers, private-label finishing.',
            ],
            [
                'title' => 'Golf',
                'description' => 'Golf team and corporate apparel produced for clubs, schools, and premium programs where presentation quality matters.',
                'details' => 'Polos, quarter-zips, outerwear, embroidery, event-ready branding.',
            ],
            [
                'title' => 'Esports',
                'description' => 'Esports jerseys and lifestyle teamwear designed for organizations, creators, and brands building a recognizable identity in bulk.',
                'details' => 'Competition jerseys, hoodies, creator merch, private-label options.',
            ],
            [
                'title' => 'Ultimate Frisbee',
                'description' => 'Ultimate frisbee uniforms manufactured for clubs and tournament programs that need lightweight kits and fast brand execution.',
                'details' => 'Game jerseys, shorts, pinnies, travel apparel, consistent team graphics.',
            ],
        ];

        $galleryImages = [
            asset('images/hero-slider/01.jpeg'),
            asset('images/hero-slider/02.jpeg'),
            asset('images/hero-slider/03.jpeg'),
            asset('images/hero-slider/04.jpeg'),
            asset('images/hero-slider/05.jpeg'),
            asset('images/hero-slider/06.jpeg'),
        ];
    @endphp

    <section
        class="relative overflow-hidden border-b border-black bg-neutral-dark py-24 text-white lg:py-28"
        style="background-image: linear-gradient(100deg, rgba(0, 0, 0, 0.9) 0%, rgba(0, 0, 0, 0.7) 42%, rgba(0, 0, 0, 0.18) 100%), url('{{ asset('images/hero-slider/01.jpeg') }}'); background-size: cover; background-position: center;"
    >
        <div class="max-w-[1440px] mx-auto px-6 lg:px-12 relative z-10">
            <span class="inline-flex border border-white px-4 py-2 text-sm font-bold uppercase tracking-[0.18em] text-gray-300">
                Bulk Category Page
            </span>
            <h1 class="mt-6 max-w-5xl font-heading text-5xl font-extrabold uppercase leading-[1.02] tracking-[-0.03em] md:text-6xl lg:text-7xl">
                Custom Team <span class="text-gray-300">Uniforms</span>
            </h1>
            <p class="mt-6 max-w-3xl text-lg font-medium leading-[1.5] text-gray-300 md:text-xl">
                Built for clubs, schools, distributors, and private-label buyers who need custom teamwear in bulk. This page is designed to convert inquiry-led customers, not retail product shoppers.
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

    <section class="border-b border-black bg-white py-12 shadow-sm">
        <div class="max-w-[1440px] mx-auto px-6 lg:px-12">
            <div class="grid grid-cols-2 gap-6 text-center md:grid-cols-4 divide-x divide-black">
                <div class="flex flex-col items-center justify-center p-2">
                    <span class="font-heading text-4xl text-dark md:text-5xl">Low MOQ</span>
                    <span class="text-[14px] font-bold uppercase tracking-[0.05em] text-neutral-dark">Flexible Bulk Programs</span>
                </div>
                <div class="flex flex-col items-center justify-center p-2">
                    <span class="font-heading text-4xl text-dark md:text-5xl">OEM</span>
                    <span class="text-[14px] font-bold uppercase tracking-[0.05em] text-neutral-dark">Private Label Ready</span>
                </div>
                <div class="flex flex-col items-center justify-center p-2">
                    <span class="font-heading text-4xl text-dark md:text-5xl">2 Weeks</span>
                    <span class="text-[14px] font-bold uppercase tracking-[0.05em] text-neutral-dark">Production Lead Time</span>
                </div>
                <div class="flex flex-col items-center justify-center p-2">
                    <span class="font-heading text-4xl text-dark md:text-5xl">Global</span>
                    <span class="text-[14px] font-bold uppercase tracking-[0.05em] text-neutral-dark">Wholesale Fulfillment</span>
                </div>
            </div>
        </div>
    </section>

    <section class="border-b border-black bg-light py-20 lg:py-24">
        <div class="max-w-[1440px] mx-auto px-6 lg:px-12">
            <div class="grid grid-cols-1 gap-12 lg:grid-cols-[1.1fr_0.9fr] lg:gap-16">
                <div>
                    <p class="text-[14px] font-semibold uppercase tracking-[0.12em] text-neutral-dark">Category Overview</p>
                    <h2 class="mt-3 font-heading text-4xl font-bold leading-[1.1] tracking-[-0.02em] text-dark md:text-[52px]">
                        Team Uniform Manufacturing For Buyers Who Need Reliable Reorders
                    </h2>
                    <div class="mt-6 space-y-5 text-[18px] leading-relaxed text-neutral-dark">
                        <p>
                            This category page is built for bulk-order customers. Instead of pushing individual products, it presents the category as a manufacturing capability with clear sub-category coverage, production depth, and visual proof of output quality.
                        </p>
                        <p>
                            Troopers Sports manufactures full custom team uniform programs for clubs, schools, academies, retailers, and private-label brands. Buyers can use this page to understand the available sub-categories, branding methods, and the breadth of styles available before starting a quote request.
                        </p>
                        <p>
                            Every order can be tailored around sport, fit, fabric, branding method, and reorder strategy. That makes this page more useful for lead generation than a conventional retail category grid.
                        </p>
                    </div>
                </div>

                <div class="border border-black bg-white p-8 lg:p-10">
                    <p class="text-[14px] font-semibold uppercase tracking-[0.12em] text-neutral-dark">Best Fit For</p>
                    <div class="mt-6 grid grid-cols-1 gap-4">
                        <div class="border border-black bg-light p-5">
                            <h3 class="text-[20px] font-semibold text-dark">Sports Clubs & Academies</h3>
                            <p class="mt-2 text-[16px] leading-relaxed text-neutral-dark">Seasonal uniform programs, age-group sizing, and sponsor-ready branding.</p>
                        </div>
                        <div class="border border-black bg-light p-5">
                            <h3 class="text-[20px] font-semibold text-dark">Retailers & Distributors</h3>
                            <p class="mt-2 text-[16px] leading-relaxed text-neutral-dark">Margin-focused wholesale production with stable quality across repeat orders.</p>
                        </div>
                        <div class="border border-black bg-light p-5">
                            <h3 class="text-[20px] font-semibold text-dark">Private Label Brands</h3>
                            <p class="mt-2 text-[16px] leading-relaxed text-neutral-dark">OEM teamwear backed by labeling, packaging, and category expansion support.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="border-b border-black bg-white py-20 lg:py-24">
        <div class="max-w-[1440px] mx-auto px-6 lg:px-12">
            <div class="grid grid-cols-1 gap-10 lg:grid-cols-[0.85fr_1.15fr] lg:items-end">
                <div class="max-w-3xl">
                    <p class="text-[14px] font-semibold uppercase tracking-[0.12em] text-neutral-dark">Sub Categories</p>
                    <h2 class="mt-3 font-heading text-4xl font-bold leading-[1.1] tracking-[-0.02em] text-dark md:text-[48px]">
                        Built To Cover Every Layer Of A Teamwear Program
                    </h2>
                    <p class="mt-4 text-[18px] leading-relaxed text-neutral-dark">
                        This dedicated sub-category section helps bulk buyers understand the range inside the main category before they request pricing, sampling, or MOQ guidance.
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-4 md:grid-cols-3">
                    @foreach ($subCategories as $index => $subCategory)
                        <div class="border border-black bg-light px-4 py-5">
                            <p class="text-[12px] font-bold uppercase tracking-[0.16em] text-neutral-dark">
                                {{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}
                            </p>
                            <p class="mt-2 text-[15px] font-semibold leading-snug text-dark">
                                {{ $subCategory['title'] }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mt-12 grid grid-cols-1 gap-8 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($subCategories as $subCategory)
                    <article class="group border border-black bg-light p-8 transition-all duration-300 hover:bg-dark">
                        <h3 class="text-[24px] font-semibold leading-tight text-dark transition-colors group-hover:text-white">
                            {{ $subCategory['title'] }}
                        </h3>
                        <p class="mt-4 text-[17px] leading-relaxed text-neutral-dark transition-colors group-hover:text-gray-300">
                            {{ $subCategory['description'] }}
                        </p>
                        <p class="mt-6 border-t border-black pt-4 text-[14px] font-semibold uppercase tracking-[0.08em] text-neutral-dark transition-colors group-hover:border-white group-hover:text-gray-300">
                            {{ $subCategory['details'] }}
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
                    <p class="text-[14px] font-semibold uppercase tracking-[0.12em] text-neutral-dark">Category Gallery</p>
                    <h2 class="mt-3 font-heading text-4xl font-bold leading-[1.1] tracking-[-0.02em] text-dark md:text-[48px]">
                        Visual Direction For This Category
                    </h2>
                    <p class="mt-4 text-[18px] leading-relaxed text-neutral-dark">
                        Use this gallery block to showcase representative items from the category and help bulk buyers quickly understand style range, branding flexibility, and finish level.
                    </p>
                </div>
                <a href="{{ route('contact') }}" class="btn btn-outline-dark btn-md shrink-0">
                    ASK ABOUT THIS CATEGORY
                </a>
            </div>

            <div class="mt-12 grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($galleryImages as $index => $galleryImage)
                    <figure class="group overflow-hidden border border-black bg-white">
                        <div class="aspect-[4/3] overflow-hidden bg-neutral-dark">
                            <img
                                src="{{ $galleryImage }}"
                                alt="Custom Team Uniforms gallery image {{ $index + 1 }}"
                                class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                                loading="lazy"
                            >
                        </div>
                        <figcaption class="border-t border-black bg-white p-5">
                            <p class="text-[14px] font-semibold uppercase tracking-[0.12em] text-neutral-dark">
                                Category Item {{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}
                            </p>
                            <p class="mt-2 text-[17px] leading-relaxed text-dark">
                                Bulk-ready teamwear imagery for presentations, buyer qualification, and wholesale inquiry pages.
                            </p>
                        </figcaption>
                    </figure>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-black py-20 text-white">
        <div class="max-w-[1440px] mx-auto px-6 lg:px-12">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-[1.2fr_0.8fr] lg:items-center">
                <div>
                    <p class="text-[14px] font-semibold uppercase tracking-[0.12em] text-gray-300">Inquiry First</p>
                    <h2 class="mt-3 font-heading text-4xl font-bold uppercase leading-[1.05] tracking-[-0.02em] md:text-[52px]">
                        Turn This Category Into A Bulk Order Conversation
                    </h2>
                    <p class="mt-5 max-w-3xl text-[18px] leading-relaxed text-gray-300">
                        This page is intentionally designed to move visitors toward a quote request. It explains category breadth, shows visual proof, and keeps the next step focused on inquiry rather than checkout.
                    </p>
                </div>
                <div class="flex flex-col gap-4 lg:items-end">
                    <a href="{{ route('contact') }}" class="btn btn-light btn-md w-full justify-center lg:w-auto">
                        GET A CATEGORY QUOTE
                    </a>
                    <a href="https://wa.me/923418649479" class="btn btn-outline-light btn-md w-full justify-center lg:w-auto">
                        MESSAGE THE FACTORY TEAM
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
