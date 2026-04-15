@extends('layouts.dashboard')

@section('title', 'SEO Settings · Admin')
@section('page-heading', 'SEO Settings')

@section('content')
    <div class="space-y-6">
        @if (session('status'))
            <div class="rounded-lg border border-emerald-500/30 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-200">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="rounded-lg border border-rose-500/30 bg-rose-500/10 px-4 py-3 text-sm text-rose-200">
                <ul class="space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <x-dashboard.card title="Static Page SEO" subtitle="Manage titles, meta descriptions, and schema JSON for each static page. If schema is left blank, a valid WebPage schema is generated automatically.">
            <form method="POST" action="{{ route('admin.seo-settings.pages') }}" class="space-y-6">
                @csrf
                @method('PATCH')

                @foreach ($pages as $index => $page)
                    <div class="rounded-lg border border-slate-800 bg-slate-950/60 p-4">
                        <input type="hidden" name="pages[{{ $index }}][page_key]" value="{{ $page->page_key }}">

                        <div class="grid gap-4 md:grid-cols-2">
                            <div>
                                <label class="mb-1 block text-xs font-medium uppercase tracking-[0.08em] text-slate-400">Page Key</label>
                                <input
                                    type="text"
                                    value="{{ $page->page_key }}"
                                    disabled
                                    class="w-full rounded-md border border-slate-700 bg-slate-900 px-3 py-2 text-sm text-slate-400"
                                >
                            </div>
                            <div>
                                <label class="mb-1 block text-xs font-medium uppercase tracking-[0.08em] text-slate-400">Page Name</label>
                                <input
                                    type="text"
                                    name="pages[{{ $index }}][page_name]"
                                    value="{{ old("pages.$index.page_name", $page->page_name) }}"
                                    class="w-full rounded-md border border-slate-700 bg-slate-950 px-3 py-2 text-sm text-slate-100 focus:border-sky-400 focus:ring-sky-400"
                                >
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="mb-1 block text-xs font-medium uppercase tracking-[0.08em] text-slate-400">Meta Title</label>
                            <input
                                type="text"
                                name="pages[{{ $index }}][meta_title]"
                                value="{{ old("pages.$index.meta_title", $page->meta_title) }}"
                                class="w-full rounded-md border border-slate-700 bg-slate-950 px-3 py-2 text-sm text-slate-100 focus:border-sky-400 focus:ring-sky-400"
                                placeholder="SEO title for this page"
                            >
                        </div>

                        <div class="mt-4">
                            <label class="mb-1 block text-xs font-medium uppercase tracking-[0.08em] text-slate-400">Meta Description</label>
                            <textarea
                                rows="3"
                                name="pages[{{ $index }}][meta_description]"
                                class="w-full rounded-md border border-slate-700 bg-slate-950 px-3 py-2 text-sm text-slate-100 focus:border-sky-400 focus:ring-sky-400"
                                placeholder="Meta description for this page"
                            >{{ old("pages.$index.meta_description", $page->meta_description) }}</textarea>
                        </div>

                        <div class="mt-4">
                            <label class="mb-1 block text-xs font-medium uppercase tracking-[0.08em] text-slate-400">Schema JSON</label>
                            <textarea
                                rows="7"
                                name="pages[{{ $index }}][schema_json]"
                                class="w-full rounded-md border border-slate-700 bg-slate-950 px-3 py-2 font-mono text-xs text-slate-100 focus:border-sky-400 focus:ring-sky-400"
                                placeholder='{"context":"https://schema.org","type":"WebPage"}'
                            >{{ old("pages.$index.schema_json", $page->schema_json) }}</textarea>
                        </div>
                    </div>
                @endforeach

                <div class="rounded-lg border border-dashed border-slate-700 bg-slate-950/40 p-4">
                    <p class="mb-3 text-sm font-medium text-white">Add New Static Page for Future SEO</p>
                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <label class="mb-1 block text-xs font-medium uppercase tracking-[0.08em] text-slate-400">New Page Key</label>
                            <input
                                type="text"
                                name="new_page_key"
                                value="{{ old('new_page_key') }}"
                                class="w-full rounded-md border border-slate-700 bg-slate-950 px-3 py-2 text-sm text-slate-100 focus:border-sky-400 focus:ring-sky-400"
                                placeholder="e.g. pricing"
                            >
                        </div>
                        <div>
                            <label class="mb-1 block text-xs font-medium uppercase tracking-[0.08em] text-slate-400">New Page Name</label>
                            <input
                                type="text"
                                name="new_page_name"
                                value="{{ old('new_page_name') }}"
                                class="w-full rounded-md border border-slate-700 bg-slate-950 px-3 py-2 text-sm text-slate-100 focus:border-sky-400 focus:ring-sky-400"
                                placeholder="e.g. Pricing"
                            >
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="rounded-md bg-sky-500 px-4 py-2 text-sm font-semibold text-slate-950 transition hover:bg-sky-400">
                        Save SEO Settings
                    </button>
                </div>
            </form>
        </x-dashboard.card>

        <x-dashboard.card title="Header & Footer Script Injection" subtitle="Inject scripts into frontend head section and before closing body tag. Use carefully.">
            <form method="POST" action="{{ route('admin.seo-settings.scripts') }}" class="space-y-4">
                @csrf
                @method('PATCH')

                <div>
                    <label class="mb-1 block text-xs font-medium uppercase tracking-[0.08em] text-slate-400">Header Scripts</label>
                    <textarea
                        rows="8"
                        name="header_scripts"
                        class="w-full rounded-md border border-slate-700 bg-slate-950 px-3 py-2 font-mono text-xs text-slate-100 focus:border-sky-400 focus:ring-sky-400"
                        placeholder="Script tag for analytics"
                    >{{ old('header_scripts', $scripts->header_scripts) }}</textarea>
                </div>

                <div>
                    <label class="mb-1 block text-xs font-medium uppercase tracking-[0.08em] text-slate-400">Footer Scripts</label>
                    <textarea
                        rows="8"
                        name="footer_scripts"
                        class="w-full rounded-md border border-slate-700 bg-slate-950 px-3 py-2 font-mono text-xs text-slate-100 focus:border-sky-400 focus:ring-sky-400"
                        placeholder="Script tag for chat widget"
                    >{{ old('footer_scripts', $scripts->footer_scripts) }}</textarea>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="rounded-md bg-sky-500 px-4 py-2 text-sm font-semibold text-slate-950 transition hover:bg-sky-400">
                        Save Script Settings
                    </button>
                </div>
            </form>
        </x-dashboard.card>
    </div>
@endsection
