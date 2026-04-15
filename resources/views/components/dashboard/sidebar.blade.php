<aside class="fixed inset-y-0 left-0 z-40 hidden w-72 border-r border-slate-800 bg-slate-900/95 lg:block">
        <div class="flex h-full flex-col">
            <div class="flex h-16 items-center gap-3 border-b border-slate-800 px-6">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-sky-500/15 text-sky-300">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 18l6-6-6-6M8 6l-6 6 6 6"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-white">Trooper Sports</p>
                    <p class="text-xs text-slate-400">Analytics Suite</p>
                </div>
            </div>

            <nav class="space-y-1 px-4 py-5">
                <x-dashboard.sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    <x-slot:icon>
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.5h8v7H3zm10-10h8v17h-8zM3 3.5h8V11H3z"/>
                        </svg>
                    </x-slot:icon>
                    Dashboard
                </x-dashboard.sidebar-link>

                <x-dashboard.sidebar-link :href="route('analytics')" :active="request()->routeIs('analytics')">
                    <x-slot:icon>
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5h15M7 16V9m5 7V5m5 11v-6"/>
                        </svg>
                    </x-slot:icon>
                    Analytics
                </x-dashboard.sidebar-link>

                <x-dashboard.sidebar-link :href="route('admin.seo-settings')" :active="request()->routeIs('admin.seo-settings*')">
                    <x-slot:icon>
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3.75 4.5 7.5v9L12 20.25l7.5-3.75v-9L12 3.75Zm0 0v16.5"/>
                        </svg>
                    </x-slot:icon>
                    SEO Settings
                </x-dashboard.sidebar-link>
            </nav>
        </div>
    </aside>

<div x-show="sidebarOpen" x-cloak class="fixed inset-0 z-50 lg:hidden" role="dialog" aria-modal="true">
        <div x-show="sidebarOpen" x-transition.opacity class="absolute inset-0 bg-slate-950/70" @click="sidebarOpen = false"></div>

        <aside x-show="sidebarOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full" class="absolute inset-y-0 left-0 w-72 border-r border-slate-800 bg-slate-900">
            <div class="flex h-16 items-center justify-between border-b border-slate-800 px-4">
                <p class="text-sm font-semibold text-white">Navigation</p>
                <button type="button" class="rounded-md border border-slate-700 p-2 text-slate-300" @click="sidebarOpen = false">
                    <span class="sr-only">Close sidebar</span>
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <nav class="space-y-1 px-4 py-5">
                <x-dashboard.sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    <x-slot:icon>
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.5h8v7H3zm10-10h8v17h-8zM3 3.5h8V11H3z"/>
                        </svg>
                    </x-slot:icon>
                    Dashboard
                </x-dashboard.sidebar-link>

                <x-dashboard.sidebar-link :href="route('analytics')" :active="request()->routeIs('analytics')">
                    <x-slot:icon>
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5h15M7 16V9m5 7V5m5 11v-6"/>
                        </svg>
                    </x-slot:icon>
                    Analytics
                </x-dashboard.sidebar-link>

                <x-dashboard.sidebar-link :href="route('admin.seo-settings')" :active="request()->routeIs('admin.seo-settings*')">
                    <x-slot:icon>
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3.75 4.5 7.5v9L12 20.25l7.5-3.75v-9L12 3.75Zm0 0v16.5"/>
                        </svg>
                    </x-slot:icon>
                    SEO Settings
                </x-dashboard.sidebar-link>
            </nav>
        </aside>
    </div>
