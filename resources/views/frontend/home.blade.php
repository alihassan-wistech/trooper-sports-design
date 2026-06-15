@extends('frontend.layouts.app')

@section('title', 'Troopers Sports – Premium Factory-Direct Custom Sportswear')

@section('content')
    @php
        $heroSlides = [
            [
                'image' => asset('images/hero-slider/01.jpeg'),
                'title' => '25,000 Units Every Month.<br>2-Week Turnaround.<br><span class="text-gray-300">Direct from Sialkot Factory.</span>',
                'description' => 'No middlemen. No 6–8 week waits. Just premium custom sportswear, team wear & fitness gear at real wholesale prices that protect your margins.',
                'primary' => ['label' => 'GET WHOLESALE QUOTE IN 24 HOURS', 'url' => route('contact'), 'class' => 'btn btn-light btn-md'],
                'secondary' => ['label' => 'See Our Full Capabilities', 'url' => route('contact'), 'class' => 'btn btn-outline-light btn-md'],
            ],
            [
                'image' => asset('images/hero-slider/02.jpeg'),
                'title' => 'Your Brand. Your Design.<br><span class="text-gray-300">Our Quality. Your Profit.</span>',
                'description' => 'Full customization (logos, names, numbers, colors) + fastest sublimation & heat transfer in Sialkot. Perfect for teams, retailers, private labels and wholesalers.',
                'primary' => ['label' => 'START YOUR CUSTOM PROJECT', 'url' => route('contact'), 'class' => 'btn btn-light btn-md'],
                'secondary' => ['label' => 'Browse 200+ Products', 'url' => route('contact'), 'class' => 'btn btn-outline-light btn-md'],
            ],
            [
                'image' => asset('images/hero-slider/03.jpeg'),
                'title' => 'Trusted by Teams & Brands in <span class="text-gray-300">15+ Countries</span>',
                'description' => 'Low MOQ • Bulk Discounts • OEM & Private Label • Worldwide Shipping • 100% Quality Guarantee',
                'primary' => ['label' => 'BECOME A PARTNER TODAY', 'url' => route('contact'), 'class' => 'btn btn-light btn-md'],
                'secondary' => ['label' => 'Chat with Sales on WhatsApp', 'url' => 'https://wa.me/923418649479', 'class' => 'btn btn-outline-light btn-md'],
                'secondary_icon' => 'whatsapp',
            ],
            [
                'image' => asset('images/hero-slider/04.jpeg'),
                'title' => 'Retail-Ready Sportswear.<br><span class="text-gray-300">Built for Reorders.</span>',
                'description' => 'Consistent sizing, durable trims, and dependable production planning for shops, distributors, and sportswear brands that need repeatable quality.',
                'primary' => ['label' => 'PLAN YOUR NEXT ORDER', 'url' => route('contact'), 'class' => 'btn btn-light btn-md'],
                'secondary' => ['label' => 'Discuss Private Label Options', 'url' => route('contact'), 'class' => 'btn btn-outline-light btn-md'],
            ],
            [
                'image' => asset('images/hero-slider/05.jpeg'),
                'title' => 'From Samples to Bulk Runs.<br><span class="text-gray-300">One Manufacturing Partner.</span>',
                'description' => 'We help you move from concept to approved sample to full production without juggling multiple vendors, delays, or quality compromises.',
                'primary' => ['label' => 'REQUEST A SAMPLE PLAN', 'url' => route('contact'), 'class' => 'btn btn-light btn-md'],
                'secondary' => ['label' => 'Review Production Workflow', 'url' => route('contact'), 'class' => 'btn btn-outline-light btn-md'],
            ],
            [
                'image' => asset('images/hero-slider/06.jpeg'),
                'title' => 'Serious Capacity.<br><span class="text-gray-300">Responsive Communication.</span>',
                'description' => 'Factory-direct coordination, fast answers, and scalable output for clubs, academies, wholesalers, and growing global sportswear programs.',
                'primary' => ['label' => 'TALK TO THE FACTORY TEAM', 'url' => route('contact'), 'class' => 'btn btn-light btn-md'],
                'secondary' => ['label' => 'Get Delivery Timelines', 'url' => route('contact'), 'class' => 'btn btn-outline-light btn-md'],
            ],
            [
                'image' => asset('images/hero-slider/07.jpeg'),
                'title' => 'Performance Gear at Scale.<br><span class="text-gray-300">Built for Serious Buyers.</span>',
                'description' => 'From club orders to wholesale programs, we deliver dependable manufacturing, clean finishing, and repeatable quality across every production run.',
                'primary' => ['label' => 'REQUEST A BULK QUOTE', 'url' => route('contact'), 'class' => 'btn btn-light btn-md'],
                'secondary' => ['label' => 'Explore Manufacturing Options', 'url' => route('contact'), 'class' => 'btn btn-outline-light btn-md'],
            ],
        ];

        $whatWeOfferCards = [
            [
                'number' => '01',
                'icon' => asset('images/what-we-offer/1.png'),
                'title' => 'Cut & Sew Customization',
                'description' => 'Tailor-made apparel using cut & sew services. We handle every detail from fabric cutting to final stitching — your designs, our craftsmanship.',
            ],
            [
                'number' => '02',
                'icon' => asset('images/what-we-offer/2.png'),
                'title' => 'Heat Transfer & Vinyl Printing',
                'description' => 'Perfect for names, numbers, and logos. A great option for team uniforms, promotional wear, or fast custom orders.',
            ],
            [
                'number' => '03',
                'icon' => asset('images/what-we-offer/3.png'),
                'title' => 'Private Labeling & Branding',
                'description' => 'We offer woven labels, printed neck labels, hang tags, packaging, and complete branding solutions for your apparel line.',
            ],
            [
                'number' => '04',
                'icon' => asset('images/what-we-offer/4.png'),
                'title' => 'Custom Embroidery',
                'description' => 'High-density stitching adds a premium, textured finish to your logos and custom branding for a long-lasting aesthetic on any garment.',
            ],
            [
                'number' => '05',
                'icon' => asset('images/what-we-offer/5.png'),
                'title' => 'Sublimation Printing',
                'description' => 'Vibrant full-color sublimation printing for teamwear, jerseys, and sports apparel. Long-lasting, fade-resistant results on 100% polyester fabrics.',
            ],
            [
                'number' => '06',
                'icon' => asset('images/what-we-offer/6.png'),
                'title' => 'Screen Printing',
                'description' => 'Traditional screen printing for bold, durable designs on t-shirts, hoodies, and more. Ideal for large volumes and sharp logos.',
            ],
            [
                'number' => '07',
                'icon' => asset('images/what-we-offer/6.png'),
                'title' => 'Product Prototyping & Sampling',
                'description' => 'From initial concept to finished sample — we prototype and test every detail before you commit to a full production run.',
            ],
        ];
    @endphp

    <!-- 2. Hero Section -->
    <section class="relative h-[100vh] max-h-[700px] min-h-[450px] bg-neutral-dark overflow-hidden border-b border-black">
        <div class="swiper hero-swiper h-full">
            <div class="swiper-wrapper">
                @foreach ($heroSlides as $heroSlide)
                    <div class="swiper-slide relative">
                        <div
                            class="absolute inset-0 z-0 bg-cover bg-center bg-no-repeat"
                            style="background-image: linear-gradient(100deg, rgba(0, 0, 0, 0.88) 0%, rgba(0, 0, 0, 0.78) 34%, rgba(0, 0, 0, 0.46) 62%, rgba(0, 0, 0, 0.14) 82%, rgba(0, 0, 0, 0.03) 100%), url('{{ $heroSlide['image'] }}');"
                        ></div>
                        <div class="max-w-[1440px] mx-auto px-6 lg:px-12 relative z-10 w-full text-white h-full flex items-center">
                            <div class="max-w-3xl">
                                <h1 class="font-heading text-4xl md:text-5xl lg:text-6xl font-extrabold leading-[1.1] tracking-[-0.02em]">
                                    {!! $heroSlide['title'] !!}
                                </h1>
                                <p class="mt-6 text-lg md:text-xl font-medium leading-[1.4] text-gray-300">
                                    {{ $heroSlide['description'] }}
                                </p>
                                <div class="mt-10 flex flex-col sm:flex-row gap-4">
                                    <a href="{{ $heroSlide['primary']['url'] }}" class="{{ $heroSlide['primary']['class'] }}">
                                        {{ $heroSlide['primary']['label'] }}
                                    </a>
                                    <a href="{{ $heroSlide['secondary']['url'] }}" class="{{ $heroSlide['secondary']['class'] }}">
                                        @if (($heroSlide['secondary_icon'] ?? null) === 'whatsapp')
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16"><path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/></svg>
                                        @endif
                                        {{ $heroSlide['secondary']['label'] }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="hero-pagination absolute bottom-8 left-0 right-0 z-20 text-center"></div>
        </div>
    </section>

    <!-- 3. Trust Bar -->
    <div class="bg-white border-b border-black py-6 shadow-sm">
        <div class="max-w-[1440px] mx-auto px-6 lg:px-12">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center divide-x divide-black">
                <div class="flex flex-col items-center justify-center p-2">
                    <svg class="w-8 h-8 text-black mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    <span class="text-[18px] font-bold text-dark">25,000+ Units/Month</span>
                    <span class="text-[14px] font-medium text-neutral-dark">Production Capacity</span>
                </div>
                <div class="flex flex-col items-center justify-center p-2">
                    <svg class="w-8 h-8 text-black mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="text-[18px] font-bold text-dark">2 Weeks Turnaround</span>
                    <span class="text-[14px] font-medium text-neutral-dark">Fastest in Sialkot</span>
                </div>
                <div class="flex flex-col items-center justify-center p-2">
                    <svg class="w-8 h-8 text-black mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    <span class="text-[18px] font-bold text-dark">Direct Factory</span>
                    <span class="text-[14px] font-medium text-neutral-dark">No Middlemen, Best Price</span>
                </div>
                <div class="flex flex-col items-center justify-center p-2">
                    <svg class="w-8 h-8 text-black mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="text-[18px] font-bold text-dark">Worldwide Shipping</span>
                    <span class="text-[14px] font-medium text-neutral-dark">To 15+ Countries</span>
                </div>
            </div>
        </div>
    </div>

    <!-- 4. What We Build (Category-led, Detail-page First) -->
    <section id="what-we-build" class="py-20 lg:py-24 bg-white border-b border-black">
        <div class="max-w-[1440px] mx-auto px-6 lg:px-12">
            <div class="text-center max-w-4xl mx-auto mb-12">
                <h2 class="font-heading text-4xl md:text-[48px] font-bold tracking-[-0.02em] text-dark leading-[1.2]">
                    What We Build For Teams, Brands & Clubs
                </h2>
                <p class="mt-4 text-xl md:text-[24px] font-medium text-neutral-dark leading-[1.4]">
                    Browse by category. Each card opens a full detail page with materials, construction, branding options, MOQ, and lead time.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <article class="group border border-black bg-light transition-all duration-300 hover:bg-dark">
                    <div class="aspect-[16/10] border-b border-black bg-gray-200 flex items-center justify-center">
                        <span class="font-heading text-4xl text-neutral-dark group-hover:text-white transition-colors">TEAM WEAR</span>
                    </div>
                    <div class="p-8">
                        <h3 class="text-[24px] font-semibold text-dark group-hover:text-white transition-colors">Custom Team Uniforms</h3>
                        <p class="mt-3 text-[17px] leading-relaxed text-neutral-dark group-hover:text-white transition-colors">
                            Built for match-day performance with sport-specific cuts, panel mapping, and durable branding methods.
                        </p>
                        <ul class="mt-5 space-y-2 text-[15px] text-neutral-dark group-hover:text-gray-300 transition-colors">
                            <li>AFL, basketball, cricket, soccer, rugby</li>
                            <li>Game jerseys, shorts, warm-up sets</li>
                            <li>Sublimation, embroidery, heat transfer</li>
                        </ul>
                        <a href="{{ route('categories.team-uniforms') }}" class="mt-6 btn btn-light btn-sm btn-fixed-on-group">
                            VIEW UNIFORM DETAIL PAGE <span>→</span>
                        </a>
                    </div>
                </article>

                <article class="group border border-black bg-light transition-all duration-300 hover:bg-dark">
                    <div class="aspect-[16/10] border-b border-black bg-gray-200 flex items-center justify-center">
                        <span class="font-heading text-4xl text-neutral-dark group-hover:text-white transition-colors">APPAREL</span>
                    </div>
                    <div class="p-8">
                        <h3 class="text-[24px] font-semibold text-dark group-hover:text-white transition-colors">Custom Team Apparel</h3>
                        <p class="mt-3 text-[17px] leading-relaxed text-neutral-dark group-hover:text-white transition-colors">
                            Off-field and training apparel engineered for comfort, fit consistency, and repeat-season reorders.
                        </p>
                        <ul class="mt-5 space-y-2 text-[15px] text-neutral-dark group-hover:text-gray-300 transition-colors">
                            <li>Polos, hoodies, jackets, training tees</li>
                            <li>Performance and fleece material options</li>
                            <li>Private label and retail-ready finishing</li>
                        </ul>
                        <a href="{{ route('contact') }}" class="mt-6 btn btn-light btn-sm btn-fixed-on-group">
                            VIEW APPAREL DETAIL PAGE <span>→</span>
                        </a>
                    </div>
                </article>

                <article class="group border border-black bg-light transition-all duration-300 hover:bg-dark">
                    <div class="aspect-[16/10] border-b border-black bg-gray-200 flex items-center justify-center">
                        <span class="font-heading text-4xl text-neutral-dark group-hover:text-white transition-colors">MERCH</span>
                    </div>
                    <div class="p-8">
                        <h3 class="text-[24px] font-semibold text-dark group-hover:text-white transition-colors">Club & Fan Merchandise</h3>
                        <p class="mt-3 text-[17px] leading-relaxed text-neutral-dark group-hover:text-white transition-colors">
                            Supporter and community merchandise for clubs, schools, and events with controlled quality at scale.
                        </p>
                        <ul class="mt-5 space-y-2 text-[15px] text-neutral-dark group-hover:text-gray-300 transition-colors">
                            <li>Beanies, scarves, hats, promo products</li>
                            <li>Sponsor-ready artwork placement</li>
                            <li>Bulk and seasonal reorder planning</li>
                        </ul>
                        <a href="{{ route('contact') }}" class="mt-6 btn btn-light btn-sm btn-fixed-on-group">
                            VIEW MERCH DETAIL PAGE <span>→</span>
                        </a>
                    </div>
                </article>
            </div>

        </div>
    </section>

    <!-- 5. Why Partner With Troopers Sports -->
    <section class="py-20 lg:py-24 bg-light border-b border-black">
        <div class="max-w-[1440px] mx-auto px-6 lg:px-12">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="font-heading text-4xl md:text-[48px] font-bold tracking-[-0.02em] text-dark leading-[1.2]">
                    Why Smart Buyers Choose Troopers Sports
                </h2>
                <p class="mt-4 text-xl md:text-[24px] font-medium text-neutral-dark leading-[1.4]">
                    We don’t just manufacture sportswear. We help you grow faster, earn higher margins, and deliver better quality to your customers.
                </p>
            </div>

            <!-- 3-Column Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="group bg-white hover:bg-dark p-8 lg:p-10 border border-black transition-all duration-300">
                    <div class="w-16 h-16 bg-gray-200 border border-black flex items-center justify-center mb-6 text-black group-hover:bg-dark group-hover:border-white group-hover:text-white transition-all">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-[22px] font-semibold text-dark group-hover:text-white transition-colors">Higher Margins</h3>
                    <p class="text-neutral-dark group-hover:text-white mt-3 transition-colors leading-relaxed text-[18px]">
                        Buy direct from the factory. Cut out middleman markups and keep more profit on every sale.
                    </p>
                </div>
                <!-- Card 2 -->
                <div class="group bg-white hover:bg-dark p-8 lg:p-10 border border-black transition-all duration-300">
                    <div class="w-16 h-16 bg-gray-200 border border-black flex items-center justify-center mb-6 text-black group-hover:bg-dark group-hover:border-white group-hover:text-white transition-all">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-[22px] font-semibold text-dark group-hover:text-white transition-colors">Lightning-Fast Delivery</h3>
                    <p class="text-neutral-dark group-hover:text-white mt-3 transition-colors leading-relaxed text-[18px]">
                        2-week production + reliable worldwide shipping means you never miss a sales season again.
                    </p>
                </div>
                <!-- Card 3 -->
                <div class="group bg-white hover:bg-dark p-8 lg:p-10 border border-black transition-all duration-300">
                    <div class="w-16 h-16 bg-gray-200 border border-black flex items-center justify-center mb-6 text-black group-hover:bg-dark group-hover:border-white group-hover:text-white transition-all">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path></svg>
                    </div>
                    <h3 class="text-[22px] font-semibold text-dark group-hover:text-white transition-colors">Total Customization Freedom</h3>
                    <p class="text-neutral-dark group-hover:text-white mt-3 transition-colors leading-relaxed text-[18px]">
                        Your logo, your colors, your design — fully sublimated, embroidered or printed exactly how you want it.
                    </p>
                </div>
            </div>

            <!-- Extra Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
                <div class="group bg-white hover:bg-dark p-8 transition-all duration-300 border border-black flex items-center gap-6">
                    <div class="w-14 h-14 shrink-0 bg-gray-200 border border-black flex items-center justify-center text-black group-hover:bg-dark group-hover:border-white group-hover:text-white transition-all">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-[20px] font-semibold text-dark group-hover:text-white transition-colors">Low MOQ + Bulk Discounts</h4>
                        <p class="text-neutral-dark group-hover:text-white mt-1 transition-colors">Start small or scale big.</p>
                    </div>
                </div>
                <div class="group bg-white hover:bg-dark p-8 transition-all duration-300 border border-black flex items-center gap-6">
                    <div class="w-14 h-14 shrink-0 bg-gray-200 border border-black flex items-center justify-center text-black group-hover:bg-dark group-hover:border-white group-hover:text-white transition-all">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-[20px] font-semibold text-dark group-hover:text-white transition-colors">OEM & Private Label Ready</h4>
                        <p class="text-neutral-dark group-hover:text-white mt-1 transition-colors">We build your brand, not ours.</p>
                    </div>
                </div>
            </div>

            <div class="mt-16 text-center">
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 text-black hover:text-gray-600 text-[18px] font-bold tracking-[0.02em] hover:underline underline-offset-4 transition-all">
                    Request Your Custom Quote <span>→</span>
                </a>
            </div>
        </div>
    </section>

    <!-- 6. What We Offer -->
    <section id="what-we-offer" class="py-20 lg:py-24 bg-white border-b border-black">
        <div class="max-w-[1440px] mx-auto px-6 lg:px-12">
            <div class="flex flex-col gap-8 lg:flex-row lg:items-end lg:justify-between mb-12">
                <div class="max-w-3xl">
                    <span class="inline-flex items-center border border-black bg-light px-4 py-2 text-sm font-bold uppercase tracking-[0.18em] text-neutral-dark">
                        Our Capabilities
                    </span>
                    <h2 class="mt-5 font-heading text-4xl md:text-[48px] font-bold tracking-[-0.02em] text-dark leading-[1.1]">
                        What We Offer
                    </h2>
                </div>

                <a href="{{ route('contact') }}" class="btn btn-outline-dark btn-md shrink-0">
                    Get Quote
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                        <path d="M5 12h14" />
                        <path d="m12 5 7 7-7 7" />
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-8">
                @foreach ($whatWeOfferCards as $offerCard)
                    <article class="group flex h-full flex-col border border-black bg-light p-8 transition-all duration-300 hover:bg-dark">
                        <div class="text-sm font-bold tracking-[0.2em] text-neutral-dark transition-colors group-hover:text-gray-300">
                            {{ $offerCard['number'] }}
                        </div>
                        <img
                            src="{{ $offerCard['icon'] }}"
                            alt="{{ $offerCard['title'] }}"
                            class="mt-8 h-16 w-16 object-contain"
                            loading="lazy"
                        >
                        <h3 class="mt-8 text-[24px] font-semibold leading-tight text-dark transition-colors group-hover:text-white">
                            {{ $offerCard['title'] }}
                        </h3>
                        <p class="mt-4 text-[17px] leading-relaxed text-neutral-dark transition-colors group-hover:text-gray-300">
                            {{ $offerCard['description'] }}
                        </p>
                    </article>
                @endforeach

                <article class="group flex h-full flex-col justify-between border border-black bg-dark p-8 text-white transition-all duration-300 hover:bg-black">
                    <div>
                        <h3 class="text-[24px] font-semibold leading-tight text-white">
                            Scale Your Brand
                        </h3>
                        <p class="mt-4 text-[17px] leading-relaxed text-gray-300">
                            High-performance gear engineered for elite athletes. From fabric sourcing to final stitch, we handle the heavy lifting.
                        </p>
                    </div>

                    <div class="mt-10">
                        <a href="{{ route('contact') }}" class="btn btn-outline-light btn-md">
                            Contact Us
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                                <path d="M5 12h14" />
                                <path d="m12 5 7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- 6. Our Manufacturing Process -->
    <section id="our-process" class="py-20 lg:py-24 bg-white text-dark relative overflow-hidden border-b border-black">
        <div class="max-w-[1440px] mx-auto px-6 lg:px-12 relative z-10">
            <div class="text-center mb-16">
                <p class="text-[14px] font-semibold tracking-[0.12em] uppercase text-neutral-dark">How It Works</p>
                <h2 class="mt-3 font-heading text-4xl md:text-[56px] font-bold tracking-[-0.02em] leading-[1.1] uppercase">
                    From Concept To Reality
                </h2>
            </div>

            <div class="relative max-w-6xl mx-auto">
                <div class="absolute left-5 top-0 bottom-0 w-px bg-black md:left-1/2 md:-translate-x-1/2"></div>

                <!-- Step 01 -->
                <div class="relative mb-10 md:mb-14 md:flex md:justify-start">
                    <div class="md:w-1/2 md:pr-14 pl-14 md:pl-0">
                        <article class="border border-black bg-light p-7 lg:p-8">
                            <h3 class="font-heading text-[30px] leading-[1.05] uppercase">Consultation & Tech Pack</h3>
                            <p class="mt-3 text-[16px] leading-relaxed text-neutral-dark">
                                We review your designs, reference images, sizing plans, fabric direction, and branding placement to finalize quote and timeline.
                            </p>
                        </article>
                    </div>
                    <span class="absolute left-5 top-7 -translate-x-1/2 w-9 h-9 rounded-full bg-black text-white text-[12px] font-bold flex items-center justify-center md:left-1/2">01</span>
                </div>

                <!-- Step 02 -->
                <div class="relative mb-10 md:mb-14 md:flex md:justify-end">
                    <div class="md:w-1/2 md:pl-14 pl-14 md:pl-14">
                        <article class="border border-black bg-light p-7 lg:p-8">
                            <h3 class="font-heading text-[30px] leading-[1.05] uppercase">Pattern Making</h3>
                            <p class="mt-3 text-[16px] leading-relaxed text-neutral-dark">
                                CAD pattern specialists create digital patterns aligned to your target size chart for fit consistency across all sizes.
                            </p>
                        </article>
                    </div>
                    <span class="absolute left-5 top-7 -translate-x-1/2 w-9 h-9 rounded-full bg-black text-white text-[12px] font-bold flex items-center justify-center md:left-1/2">02</span>
                </div>

                <!-- Step 03 -->
                <div class="relative mb-10 md:mb-14 md:flex md:justify-start">
                    <div class="md:w-1/2 md:pr-14 pl-14 md:pl-0">
                        <article class="border border-black bg-light p-7 lg:p-8">
                            <h3 class="font-heading text-[30px] leading-[1.05] uppercase">Pre-Production Sample</h3>
                            <p class="mt-3 text-[16px] leading-relaxed text-neutral-dark">
                                We produce a physical sample for your review so fit, fabric, artwork, and branding can be approved before bulk manufacturing.
                            </p>
                        </article>
                    </div>
                    <span class="absolute left-5 top-7 -translate-x-1/2 w-9 h-9 rounded-full bg-black text-white text-[12px] font-bold flex items-center justify-center md:left-1/2">03</span>
                </div>

                <!-- Step 04 -->
                <div class="relative mb-10 md:mb-14 md:flex md:justify-end">
                    <div class="md:w-1/2 md:pl-14 pl-14 md:pl-14">
                        <article class="border border-black bg-light p-7 lg:p-8">
                            <h3 class="font-heading text-[30px] leading-[1.05] uppercase">Sourcing & Cutting</h3>
                            <p class="mt-3 text-[16px] leading-relaxed text-neutral-dark">
                                Once approved, bulk materials are sourced, checked for quality, and precision-cut according to locked production patterns.
                            </p>
                        </article>
                    </div>
                    <span class="absolute left-5 top-7 -translate-x-1/2 w-9 h-9 rounded-full bg-black text-white text-[12px] font-bold flex items-center justify-center md:left-1/2">04</span>
                </div>

                <!-- Step 05 -->
                <div class="relative mb-10 md:mb-14 md:flex md:justify-start">
                    <div class="md:w-1/2 md:pr-14 pl-14 md:pl-0">
                        <article class="border border-black bg-light p-7 lg:p-8">
                            <h3 class="font-heading text-[30px] leading-[1.05] uppercase">Printing & Sewing</h3>
                            <p class="mt-3 text-[16px] leading-relaxed text-neutral-dark">
                                Panels move through sublimation, screen print, embroidery, or heat transfer and are assembled with reinforced stitching.
                            </p>
                        </article>
                    </div>
                    <span class="absolute left-5 top-7 -translate-x-1/2 w-9 h-9 rounded-full bg-black text-white text-[12px] font-bold flex items-center justify-center md:left-1/2">05</span>
                </div>

                <!-- Step 06 -->
                <div class="relative md:flex md:justify-end">
                    <div class="md:w-1/2 md:pl-14 pl-14 md:pl-14">
                        <article class="border border-black bg-light p-7 lg:p-8">
                            <h3 class="font-heading text-[30px] leading-[1.05] uppercase">QC, Packing & Delivery</h3>
                            <p class="mt-3 text-[16px] leading-relaxed text-neutral-dark">
                                Every piece is checked, finished, tagged, folded, packed, and dispatched with complete shipment documentation.
                            </p>
                        </article>
                    </div>
                    <span class="absolute left-5 top-7 -translate-x-1/2 w-9 h-9 rounded-full bg-black text-white text-[12px] font-bold flex items-center justify-center md:left-1/2">06</span>
                </div>
            </div>

            <div class="mt-16 text-center">
                <a href="https://wa.me/923418649479" class="btn btn-outline-dark btn-md">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
                    Book a Virtual Factory Tour
                </a>
            </div>
        </div>
    </section>

    <!-- 8. Quality, Compliance & Process -->
    <section class="py-20 lg:py-24 bg-white border-b border-black">
        <div class="max-w-[1440px] mx-auto px-6 lg:px-12">
            <div class="text-center max-w-3xl mx-auto mb-14">
                <h2 class="font-heading text-4xl md:text-[48px] font-bold tracking-[-0.02em] text-dark leading-[1.2]">
                    Quality You Can Verify
                </h2>
                <p class="mt-4 text-xl md:text-[24px] font-medium text-neutral-dark leading-[1.4]">
                    Every order follows defined quality checks, compliant material handling, and export-ready documentation standards.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-10">
                <div class="group bg-light hover:bg-dark p-8 border border-black transition-all duration-300">
                    <div class="font-heading text-[40px] text-neutral-dark group-hover:text-white transition-colors mb-3">01</div>
                    <h3 class="text-[22px] font-semibold text-dark group-hover:text-white transition-colors">Quality Management Standards</h3>
                    <p class="text-neutral-dark group-hover:text-white mt-3 text-[16px] leading-relaxed transition-colors">
                        Production follows documented SOPs, in-line checkpoints, and final inspection protocols before shipment release.
                    </p>
                </div>
                <div class="group bg-light hover:bg-dark p-8 border border-black transition-all duration-300">
                    <div class="font-heading text-[40px] text-neutral-dark group-hover:text-white transition-colors mb-3">02</div>
                    <h3 class="text-[22px] font-semibold text-dark group-hover:text-white transition-colors">Fabric & Print Compliance</h3>
                    <p class="text-neutral-dark group-hover:text-white mt-3 text-[16px] leading-relaxed transition-colors">
                        Fabrics, trims, and print methods are selected for performance, wash durability, and application suitability by product type.
                    </p>
                </div>
                <div class="group bg-light hover:bg-dark p-8 border border-black transition-all duration-300">
                    <div class="font-heading text-[40px] text-neutral-dark group-hover:text-white transition-colors mb-3">03</div>
                    <h3 class="text-[22px] font-semibold text-dark group-hover:text-white transition-colors">Responsible Production</h3>
                    <p class="text-neutral-dark group-hover:text-white mt-3 text-[16px] leading-relaxed transition-colors">
                        Structured workflows, supervised operations, and consistent process controls keep production reliable across all batches.
                    </p>
                </div>
                <div class="group bg-light hover:bg-dark p-8 border border-black transition-all duration-300">
                    <div class="font-heading text-[40px] text-neutral-dark group-hover:text-white transition-colors mb-3">04</div>
                    <h3 class="text-[22px] font-semibold text-dark group-hover:text-white transition-colors">Export Documentation</h3>
                    <p class="text-neutral-dark group-hover:text-white mt-3 text-[16px] leading-relaxed transition-colors">
                        Commercial documents, packing details, and dispatch records are prepared for smooth international shipping coordination.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="border border-black p-6 bg-white">
                    <p class="font-heading text-4xl text-dark">AQL CHECKS</p>
                    <p class="mt-2 text-neutral-dark">Multi-stage inspections are performed during cutting, sewing, and finishing to maintain consistent quality output.</p>
                </div>
                <div class="border border-black p-6 bg-white">
                    <p class="font-heading text-4xl text-dark">PRE-SHIP QC</p>
                    <p class="mt-2 text-neutral-dark">Final pre-dispatch verification checks sizing, branding placement, stitching accuracy, and packing compliance.</p>
                </div>
                <div class="border border-black p-6 bg-white">
                    <p class="font-heading text-4xl text-dark">TRACEABILITY</p>
                    <p class="mt-2 text-neutral-dark">Orders are tracked by PO and production lot to ensure clear visibility from approved sample to shipment release.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 10. Testimonial Slider -->
    <section class="py-20 lg:py-24 bg-black text-white border-b border-black">
        <div class="max-w-[1440px] mx-auto px-6 lg:px-12">
            <div class="text-center mb-12">
                <h2 class="font-heading text-4xl md:text-[48px] font-bold tracking-[-0.02em] leading-[1.2]">
                    What Buyers Say After Working With Us
                </h2>
                <p class="mt-4 text-xl md:text-[24px] font-medium text-gray-300">
                    Real-world style feedback from clubs and apparel buyers we manufacture for.
                </p>
            </div>
            <div class="swiper testimonial-swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="border border-white bg-neutral-dark p-8 lg:p-12 min-h-[320px] flex items-center">
                            <div class="w-full">
                                <p class="font-heading text-3xl md:text-4xl tracking-[-0.01em] mb-6">“Troopers handled our full basketball kit rollout exactly on timeline. Fabric feel and print consistency were strong across all sizes, and reorder communication was quick.”</p>
                                <p class="text-gray-300 text-lg">John Carter — Procurement Lead, Teamwear Distributor (USA)</p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="border border-white bg-neutral-dark p-8 lg:p-12 min-h-[320px] flex items-center">
                            <div class="w-full">
                                <p class="font-heading text-3xl md:text-4xl tracking-[-0.01em] mb-6">“We needed custom hoodies, training tops, and merch with sponsor marks. Their team aligned every placement correctly and delivered clean finishing with low return issues.”</p>
                                <p class="text-gray-300 text-lg">Elena Brooks — Category Manager, Sports Retail Group (UK)</p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="border border-white bg-neutral-dark p-8 lg:p-12 min-h-[320px] flex items-center">
                            <div class="w-full">
                                <p class="font-heading text-3xl md:text-4xl tracking-[-0.01em] mb-6">“The 2-week production window helped us avoid a major season delay. Sampling feedback was implemented fast, and bulk quality matched the approved sample.”</p>
                                <p class="text-gray-300 text-lg">Ahmed N. — Founder, Performance Apparel Label (UAE)</p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="border border-white bg-neutral-dark p-8 lg:p-12 min-h-[320px] flex items-center">
                            <div class="w-full">
                                <p class="font-heading text-3xl md:text-4xl tracking-[-0.01em] mb-6">“For our private-label launch, they supported material selection, branding methods, and packaging setup. The final product looked retail-ready and margins stayed healthy.”</p>
                                <p class="text-gray-300 text-lg">Marta Silva — Buying Director, Multi-Brand Sports Chain (EU)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex items-center justify-between gap-6">
                <div class="testimonial-pagination"></div>
                <div class="flex gap-4">
                    <button class="testimonial-prev btn btn-outline-light btn-sm">Prev</button>
                    <button class="testimonial-next btn btn-outline-light btn-sm">Next</button>
                </div>
            </div>
        </div>
    </section>

    <!-- 9. Partner Logos + Case Metrics -->
    <section class="py-20 lg:py-24 bg-light border-b border-black">
        <div class="max-w-[1440px] mx-auto px-6 lg:px-12">
            <div class="text-center mb-12">
                <h2 class="font-heading text-4xl md:text-[48px] font-bold tracking-[-0.02em] text-dark leading-[1.2]">
                    Trusted by Growing Teams & Retail Brands
                </h2>
                <p class="mt-4 text-xl md:text-[24px] font-medium text-neutral-dark">
                    From regional clubs to international distributors, partners rely on Troopers for consistent quality and dependable turnaround.
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6 mb-14">
                <div class="h-24 border border-black bg-white flex items-center justify-center font-heading text-2xl text-neutral-dark">TEAMWEAR CO</div>
                <div class="h-24 border border-black bg-white flex items-center justify-center font-heading text-2xl text-neutral-dark">PRO CLUB SUPPLY</div>
                <div class="h-24 border border-black bg-white flex items-center justify-center font-heading text-2xl text-neutral-dark">ATHLETIC HUB</div>
                <div class="h-24 border border-black bg-white flex items-center justify-center font-heading text-2xl text-neutral-dark">ELITE SPORTS</div>
                <div class="h-24 border border-black bg-white flex items-center justify-center font-heading text-2xl text-neutral-dark">MATCHDAY WEAR</div>
                <div class="h-24 border border-black bg-white flex items-center justify-center font-heading text-2xl text-neutral-dark">GLOBAL FIT</div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="group bg-white hover:bg-dark p-8 border border-black transition-all duration-300">
                    <p class="font-heading text-5xl text-dark group-hover:text-white transition-colors">+34%</p>
                    <h3 class="text-[22px] font-semibold mt-3 text-dark group-hover:text-white transition-colors">Average Partner Revenue Lift</h3>
                    <p class="text-neutral-dark group-hover:text-white mt-2 transition-colors">Teams and resellers scale faster with direct pricing, stable quality, and faster seasonal turnaround.</p>
                </div>
                <div class="group bg-white hover:bg-dark p-8 border border-black transition-all duration-300">
                    <p class="font-heading text-5xl text-dark group-hover:text-white transition-colors">-12 DAYS</p>
                    <h3 class="text-[22px] font-semibold mt-3 text-dark group-hover:text-white transition-colors">Lead Time Reduction</h3>
                    <p class="text-neutral-dark group-hover:text-white mt-2 transition-colors">Structured sampling and production planning reduce delays across repeat and bulk programs.</p>
                </div>
                <div class="group bg-white hover:bg-dark p-8 border border-black transition-all duration-300">
                    <p class="font-heading text-5xl text-dark group-hover:text-white transition-colors">78% REPEAT</p>
                    <h3 class="text-[22px] font-semibold mt-3 text-dark group-hover:text-white transition-colors">Repeat Order Rate</h3>
                    <p class="text-neutral-dark group-hover:text-white mt-2 transition-colors">Long-term clients continue with Troopers due to quality consistency and reliable order execution.</p>
                </div>
            </div>
        </div>
    </section>





@endsection
