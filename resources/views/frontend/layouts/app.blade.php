<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        $fallbackTitle = trim($__env->yieldContent('title', 'Troopers Sports – Premium Factory-Direct Custom Sportswear'));
        $resolvedTitle = $seoTitle ?? ($fallbackTitle !== '' ? $fallbackTitle : 'Troopers Sports – Premium Factory-Direct Custom Sportswear');
        $resolvedDescription = $seoMetaDescription ?? 'Troopers Sports creates premium factory-direct custom sportswear, fitness apparel, and team wear with reliable global delivery.';
    @endphp
    <title>{{ $resolvedTitle }}</title>
    <meta name="description" content="{{ $resolvedDescription }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Bebas+Neue&display=swap" rel="stylesheet">
    
    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    <style>
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        /* Black and white global theme lock */
        .bg-black,
        .bg-dark {
            background-color: #000000 !important;
        }
        .bg-neutral-dark {
            background-color: #111111 !important;
        }
        .bg-light,
        .bg-gray-100 {
            background-color: #f5f5f5 !important;
        }
        .bg-gray-200 {
            background-color: #d4d4d4 !important;
        }
        .text-black,
        .text-dark {
            color: #000000 !important;
        }
        .text-neutral-dark {
            color: #262626 !important;
        }
        .border-black {
            border-color: #000000 !important;
        }
        .border-gray,
        .border-gray-800 {
            border-color: #404040 !important;
        }
        .text-gray-300 {
            color: #d4d4d4 !important;
        }
        .text-gray-400,
        .text-gray-500 {
            color: #737373 !important;
        }
        .hover\:bg-black:hover,
        .hover\:bg-dark:hover {
            background-color: #000000 !important;
        }
        .hover\:bg-neutral-dark:hover {
            background-color: #111111 !important;
        }
        .hover\:bg-gray-100:hover {
            background-color: #e5e5e5 !important;
        }
        .hover\:bg-gray-200:hover {
            background-color: #a3a3a3 !important;
        }
        .hover\:text-black:hover {
            color: #000000 !important;
        }
        .group:hover .group-hover\:bg-dark {
            background-color: #000000 !important;
        }
        .group:hover .group-hover\:border-white {
            border-color: #ffffff !important;
        }
        .group:hover h1,
        .group:hover h2,
        .group:hover h3,
        .group:hover h4,
        .group:hover h5,
        .group:hover h6,
        .group:hover p,
        .group:hover li,
        .group:hover span,
        .group:hover svg,
        .group:hover .text-dark,
        .group:hover .text-black,
        .group:hover .text-neutral-dark {
            color: #ffffff !important;
        }
        .group:hover .btn-fixed-on-group,
        .group:hover .btn-fixed-on-group span,
        .group:hover .btn-fixed-on-group svg {
            color: #000000 !important;
            background-color: #ffffff !important;
            border-color: #000000 !important;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            border: 1px solid #000000;
            font-weight: 700;
            letter-spacing: 0.02em;
            text-align: center;
            transition: all 0.2s ease;
            cursor: pointer;
        }
        .btn-sm {
            padding: 0.75rem 1.25rem;
            font-size: 16px;
        }
        .btn-md {
            padding: 1rem 2rem;
            font-size: 18px;
        }
        .btn-primary {
            background-color: #000000;
            color: #ffffff;
            border-color: #000000;
        }
        .btn-primary:hover {
            background-color: #111111;
        }
        .btn-light {
            background-color: #ffffff;
            color: #000000;
            border-color: #000000;
        }
        .btn-light:hover {
            background-color: #e5e5e5;
        }
        .btn-outline-light {
            background-color: transparent;
            color: #ffffff;
            border: 2px solid #ffffff;
        }
        .btn-outline-light:hover {
            background-color: #ffffff;
            color: #000000;
        }
        .btn-outline-dark {
            background-color: transparent;
            color: #000000;
            border: 2px solid #000000;
        }
        .btn-outline-dark:hover {
            background-color: #000000;
            color: #ffffff;
        }
        .hero-pagination .swiper-pagination-bullet,
        .testimonial-pagination .swiper-pagination-bullet {
            width: 10px;
            height: 10px;
            background: #525252;
            opacity: 1;
            border-radius: 0;
            transition: all 0.2s ease;
        }
        .hero-pagination .swiper-pagination-bullet-active,
        .testimonial-pagination .swiper-pagination-bullet-active {
            width: 28px;
            background: #ffffff;
        }
    </style>

    @if (!empty($seoSchemaJson))
        <script type="application/ld+json">{!! $seoSchemaJson !!}</script>
    @endif

    @if (!empty($injectedHeaderScripts))
        {!! $injectedHeaderScripts !!}
    @endif
</head>
<body class="font-sans text-neutral-dark bg-light antialiased">


    <!-- 1. Navigation Bar -->
    <nav class="sticky top-0 z-50 bg-white border-b border-gray shadow-sm">
        <div class="max-w-[1440px] mx-auto px-6 lg:px-12 py-5 flex items-center justify-between">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center">
                <img src="{{ asset('images/logo.png') }}" alt="Troopers Sports logo" class="h-10 w-auto">
            </a>

            <!-- Menu -->
            <ul class="hidden lg:flex items-center gap-x-8 text-neutral-dark font-medium">
                <li><a href="{{ route('home') }}" class="hover:text-black transition-colors">Home</a></li>
                <li><a href="{{ route('about') }}" class="hover:text-black transition-colors">About Us</a></li>
                <li><a href="{{ route('contact') }}" class="hover:text-black transition-colors">Contact</a></li>
            </ul>

            <!-- WhatsApp -->
            <a href="https://wa.me/923418649479" class="hidden lg:flex btn btn-primary btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                    <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                </svg>
                <span>Chat on WhatsApp</span>
            </a>
            
            <!-- Mobile Menu Button -->
            <button id="mobileMenuToggle" class="lg:hidden text-dark" type="button" aria-label="Toggle navigation menu" aria-expanded="false" aria-controls="mobileMenuPanel">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        </div>
        <div id="mobileMenuPanel" class="lg:hidden hidden border-t border-gray bg-white">
            <div class="max-w-[1440px] mx-auto px-6 py-4">
                <ul class="flex flex-col gap-3 text-neutral-dark font-medium">
                    <li><a href="{{ route('home') }}" class="block py-2 hover:text-black transition-colors">Home</a></li>
                    <li><a href="{{ route('about') }}" class="block py-2 hover:text-black transition-colors">About Us</a></li>
                    <li><a href="{{ route('contact') }}" class="block py-2 hover:text-black transition-colors">Contact</a></li>
                </ul>
                <a href="https://wa.me/923418649479" class="mt-4 btn btn-primary btn-sm w-full">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                        <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                    </svg>
                    <span>Chat on WhatsApp</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Floating WhatsApp (Mobile) -->
    <a href="https://wa.me/923418649479" class="fixed bottom-6 right-6 z-50 lg:hidden bg-black text-white p-4 shadow-2xl flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
            <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
        </svg>
    </a>



    @yield('content')

    @include('frontend.partials.cta')
    <!-- 12. Footer -->
    <footer class="bg-black text-gray-300 pt-20 pb-10">
        <div class="max-w-[1440px] mx-auto px-6 lg:px-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 mb-16">
                <!-- Company Blurb -->
                <div class="lg:col-span-2">
                    <a href="{{ route('home') }}" class="flex items-center mb-6">
                        <img src="{{ asset('images/logo.png') }}" alt="Troopers Sports logo" class="h-10 w-auto invert">
                    </a>
                    <p class="text-gray-400 leading-relaxed max-w-md">
                        <strong>Troopers Sports – Sialkot, Pakistan</strong><br><br>
                        Direct manufacturer & exporter of premium custom sportswear, team wear, fitness apparel and American football gear since 2018. 25,000 units/month capacity. 2-week turnaround.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-white font-bold text-[18px] mb-6">Quick Links</h4>
                    <ul class="space-y-4 text-gray-400">
                        <li><a href="{{ route('home') }}#what-we-build" class="hover:text-white transition-colors">Shop Sportswear</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-white transition-colors">About Us</a></li>
                        <li><a href="{{ route('home') }}#our-process" class="hover:text-white transition-colors">Capabilities</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-white transition-colors">Contact</a></li>
                    </ul>
                </div>

                <!-- Contact Block -->
                <div>
                    <h4 class="text-white font-bold text-[18px] mb-6">Contact Us</h4>
                    <ul class="space-y-4 text-gray-400">
                        <li class="flex gap-3">
                            <span class="font-bold text-white">WhatsApp:</span> 
                            <a href="https://wa.me/923418649479" class="hover:text-white transition-colors">0341 8649479</a>
                        </li>
                        <li class="flex gap-3">
                            <span class="font-bold text-white">Email:</span> 
                            <a href="mailto:sales@trooperssports.com" class="hover:text-white transition-colors">sales@trooperssports.com</a>
                        </li>
                        <li class="flex gap-3">
                            <span class="font-bold text-white">Address:</span> 
                            <span>Rahim pur Khichian, Sialkot, Punjab 51310, Pakistan</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-gray-500">
                <p>&copy; 2026 Troopers Sports. All Rights Reserved.</p>
                <div class="flex gap-6">
                    <a href="{{ route('contact') }}" class="hover:text-white transition-colors">Privacy Policy</a>
                    <a href="{{ route('contact') }}" class="hover:text-white transition-colors">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        new Swiper(".hero-swiper", {
            loop: true,
            effect: "fade",
            fadeEffect: { crossFade: true },
            autoplay: {
                delay: 5000,
                disableOnInteraction: false
            },
            pagination: {
                el: ".hero-pagination",
                clickable: true
            }
        });

        new Swiper(".testimonial-swiper", {
            loop: true,
            autoplay: {
                delay: 6000,
                disableOnInteraction: false
            },
            pagination: {
                el: ".testimonial-pagination",
                clickable: true
            },
            navigation: {
                nextEl: ".testimonial-next",
                prevEl: ".testimonial-prev"
            }
        });

        const mobileMenuToggle = document.getElementById("mobileMenuToggle");
        const mobileMenuPanel = document.getElementById("mobileMenuPanel");

        if (mobileMenuToggle && mobileMenuPanel) {
            mobileMenuToggle.addEventListener("click", () => {
                const isOpen = !mobileMenuPanel.classList.contains("hidden");
                mobileMenuPanel.classList.toggle("hidden", isOpen);
                mobileMenuToggle.setAttribute("aria-expanded", String(!isOpen));
            });

            mobileMenuPanel.querySelectorAll("a").forEach((link) => {
                link.addEventListener("click", () => {
                    mobileMenuPanel.classList.add("hidden");
                    mobileMenuToggle.setAttribute("aria-expanded", "false");
                });
            });
        }
    </script>

    @if (!empty($injectedFooterScripts))
        {!! $injectedFooterScripts !!}
    @endif

    @stack('scripts')
</body>
</html>
