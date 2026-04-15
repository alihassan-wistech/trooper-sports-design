<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-950 text-slate-100 antialiased">
<div x-data="{ sidebarOpen: false }" class="min-h-screen">
    <x-dashboard.sidebar />

    <div class="lg:pl-72">
        <header class="sticky top-0 z-30 border-b border-slate-800 bg-slate-950/95 backdrop-blur">
            <div class="flex h-16 items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">
                <div class="flex items-center gap-3">
                    <button
                        type="button"
                        @click="sidebarOpen = true"
                        class="inline-flex items-center justify-center rounded-md border border-slate-700 p-2 text-slate-300 transition hover:border-slate-500 hover:text-white lg:hidden"
                    >
                        <span class="sr-only">Open sidebar</span>
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                        </svg>
                    </button>
                    <div>
                        <p class="text-xs uppercase tracking-[0.14em] text-slate-400">Admin Panel</p>
                        <h1 class="text-sm font-semibold text-white sm:text-base">@yield('page-heading', 'Visitor Analytics')</h1>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ url()->full() }}" class="inline-flex items-center gap-2 rounded-md border border-slate-700 px-3 py-2 text-sm font-medium text-slate-200 transition hover:border-slate-500 hover:text-white">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.93 4.93a10 10 0 1 1-1.6 11.6M4.93 4.93v5.33h5.33"/>
                        </svg>
                        Refresh Data
                    </a>

                    <div class="hidden items-center gap-3 rounded-md border border-slate-800 bg-slate-900 px-3 py-2 sm:flex">
                        <div class="flex h-8 w-8 items-center justify-center rounded-full bg-sky-500/15 text-xs font-semibold text-sky-300">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div class="leading-tight">
                            <p class="text-xs text-slate-400">Signed in as</p>
                            <p class="text-sm font-medium text-white">{{ auth()->user()->name }}</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="inline-flex items-center rounded-md border border-rose-400/30 px-3 py-2 text-sm font-medium text-rose-300 transition hover:border-rose-300 hover:text-rose-200">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <main class="px-4 py-6 sm:px-6 lg:px-8">
            @yield('content')
        </main>
    </div>
</div>

@stack('scripts')
</body>
</html>
