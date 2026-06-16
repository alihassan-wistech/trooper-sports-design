<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Troopers Sports') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Bebas+Neue&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-light font-sans text-dark antialiased">
        <main class="min-h-screen bg-light lg:grid lg:grid-cols-[minmax(0,1fr)_minmax(420px,540px)]">
            <section
                class="relative hidden overflow-hidden bg-black text-white lg:flex lg:flex-col lg:justify-between"
                style="background-image: linear-gradient(115deg, rgba(0, 0, 0, 0.92) 0%, rgba(0, 0, 0, 0.78) 48%, rgba(0, 0, 0, 0.28) 100%), url('{{ asset('images/hero-slider/01.jpeg') }}'); background-size: cover; background-position: center;"
            >
                <div class="relative z-10 px-12 py-10">
                    <a href="{{ route('home') }}" class="inline-flex items-center">
                        <img src="{{ asset('images/logo.png') }}" alt="Troopers Sports logo" class="h-12 w-auto invert">
                    </a>
                </div>

                <div class="relative z-10 px-12 pb-14">
                    <p class="text-[13px] font-bold uppercase tracking-[0.2em] text-gray-300">Factory Admin</p>
                    <h1 class="mt-4 max-w-xl font-heading text-[72px] font-bold uppercase leading-[0.95] tracking-[0] text-white">
                        Manage Direct Custom Sportswear Orders
                    </h1>
                    <p class="mt-6 max-w-lg text-[18px] leading-relaxed text-gray-300">
                        Access production inquiries, analytics, SEO controls, and customer requests from one focused workspace.
                    </p>
                    <div class="mt-10 grid max-w-xl grid-cols-3 border border-white text-center">
                        <div class="border-r border-white p-5">
                            <span class="block font-heading text-4xl text-white">25K+</span>
                            <span class="mt-1 block text-[12px] font-bold uppercase tracking-[0.12em] text-gray-300">Units</span>
                        </div>
                        <div class="border-r border-white p-5">
                            <span class="block font-heading text-4xl text-white">OEM</span>
                            <span class="mt-1 block text-[12px] font-bold uppercase tracking-[0.12em] text-gray-300">Ready</span>
                        </div>
                        <div class="p-5">
                            <span class="block font-heading text-4xl text-white">2 WK</span>
                            <span class="mt-1 block text-[12px] font-bold uppercase tracking-[0.12em] text-gray-300">Lead</span>
                        </div>
                    </div>
                </div>
            </section>

            <section class="flex min-h-screen items-center justify-center px-6 py-10 sm:px-8 lg:px-12">
                <div class="w-full max-w-[460px]">
                    <a href="{{ route('home') }}" class="inline-flex items-center">
                        <img src="{{ asset('images/logo.png') }}" alt="Troopers Sports logo" class="h-12 w-auto">
                    </a>

                    <div class="mt-8 border border-black bg-white p-6 shadow-[8px_8px_0_#000000] sm:p-8">
                        {{ $slot }}
                    </div>

                    <p class="mt-6 text-center text-[14px] font-medium text-neutral-dark">
                        <a href="{{ route('home') }}" class="underline underline-offset-4 transition-colors hover:text-black focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-4">
                            Back to public website
                        </a>
                    </p>
                </div>
            </section>
        </main>
    </body>
</html>
