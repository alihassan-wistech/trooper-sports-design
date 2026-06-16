@extends('layouts.dashboard')

@section('title', 'Categories · Admin')
@section('page-heading', 'Category Management')

@section('content')
    @php
        $publishedCount = $categories->where('is_published', true)->count();
        $draftCount = $categories->where('is_published', false)->count();
    @endphp

    <div class="space-y-6">
        @if (session('status'))
            <div class="rounded-lg border border-neutral-300 bg-neutral-100 px-4 py-3 text-sm text-neutral-950">
                {{ session('status') }}
            </div>
        @endif

        <div class="flex flex-col gap-4 rounded-xl border border-neutral-200 bg-white p-5 shadow-sm lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h2 class="text-lg font-semibold text-neutral-950">Item Categories</h2>
                <p class="mt-1 text-sm text-neutral-500">Manage homepage cards, category detail pages, and publishing status from one place.</p>
            </div>

            <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center justify-center rounded-md bg-black px-4 py-2 text-sm font-semibold text-white transition hover:bg-neutral-800">
                Add Category
            </a>
        </div>

        <div class="grid gap-4 md:grid-cols-3">
            <div class="rounded-xl border border-neutral-200 bg-white p-4 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-[0.12em] text-neutral-500">Total</p>
                <p class="mt-2 text-2xl font-semibold text-neutral-950">{{ $categories->count() }}</p>
                <p class="mt-1 text-xs text-neutral-500">Categories in admin</p>
            </div>
            <div class="rounded-xl border border-neutral-200 bg-white p-4 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-[0.12em] text-neutral-500">Published</p>
                <p class="mt-2 text-2xl font-semibold text-neutral-950">{{ $publishedCount }}</p>
                <p class="mt-1 text-xs text-neutral-500">Visible on the website</p>
            </div>
            <div class="rounded-xl border border-neutral-200 bg-white p-4 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-[0.12em] text-neutral-500">Drafts</p>
                <p class="mt-2 text-2xl font-semibold text-neutral-950">{{ $draftCount }}</p>
                <p class="mt-1 text-xs text-neutral-500">Hidden from visitors</p>
            </div>
        </div>

        <div
            x-data="{ status: 'all', search: '' }"
            class="rounded-xl border border-neutral-200 bg-white shadow-sm"
        >
            <div class="border-b border-neutral-200 p-5">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                    <div>
                        <h3 class="text-sm font-semibold text-neutral-950">Categories</h3>
                        <p class="mt-1 text-xs text-neutral-500">Published categories appear on the homepage and can open detail pages.</p>
                    </div>

                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                        <label for="category-search" class="sr-only">Search categories</label>
                        <input
                            id="category-search"
                            type="search"
                            x-model.debounce.150ms="search"
                            class="w-full rounded-md border border-neutral-300 bg-white px-3 py-2 text-sm text-neutral-950 focus:border-black focus:ring-black sm:w-64"
                            placeholder="Search name, slug, label"
                        >

                        <div class="inline-flex rounded-md border border-neutral-300 bg-neutral-50 p-1">
                            <button type="button" x-on:click="status = 'all'" :class="status === 'all' ? 'bg-white text-neutral-950 shadow-sm' : 'text-neutral-500 hover:text-neutral-950'" class="rounded px-3 py-1.5 text-xs font-semibold transition">All</button>
                            <button type="button" x-on:click="status = 'published'" :class="status === 'published' ? 'bg-white text-neutral-950 shadow-sm' : 'text-neutral-500 hover:text-neutral-950'" class="rounded px-3 py-1.5 text-xs font-semibold transition">Published</button>
                            <button type="button" x-on:click="status = 'draft'" :class="status === 'draft' ? 'bg-white text-neutral-950 shadow-sm' : 'text-neutral-500 hover:text-neutral-950'" class="rounded px-3 py-1.5 text-xs font-semibold transition">Drafts</button>
                        </div>
                    </div>
                </div>
            </div>

            @if ($categories->isEmpty())
                <div class="px-5 py-12 text-center">
                    <h3 class="text-sm font-semibold text-neutral-950">No categories yet</h3>
                    <p class="mt-1 text-sm text-neutral-500">Create the first category to start building homepage cards and detail pages.</p>
                    <a href="{{ route('admin.categories.create') }}" class="mt-4 inline-flex items-center justify-center rounded-md bg-black px-4 py-2 text-sm font-semibold text-white transition hover:bg-neutral-800">
                        Add Category
                    </a>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-neutral-200 text-sm">
                        <thead class="bg-neutral-50">
                            <tr class="text-left text-xs uppercase tracking-[0.1em] text-neutral-500">
                                <th class="px-4 py-3">Category</th>
                                <th class="px-4 py-3">Page Content</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3 text-right">Sort</th>
                                <th class="px-4 py-3 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-200 text-neutral-700">
                            @foreach ($categories as $category)
                                @php
                                    $searchText = strtolower(collect([
                                        $category->name,
                                        $category->slug,
                                        $category->card_label,
                                        $category->title,
                                    ])->filter()->implode(' '));
                                    $categoryStatus = $category->is_published ? 'published' : 'draft';
                                @endphp

                                <tr
                                    class="hover:bg-neutral-50"
                                    data-status="{{ $categoryStatus }}"
                                    data-search="{{ $searchText }}"
                                    x-show="(status === 'all' || status === $el.dataset.status) && (! search || $el.dataset.search.includes(search.toLowerCase()))"
                                >
                                    <td class="px-4 py-4">
                                        <div class="flex items-start gap-3">
                                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-md border border-neutral-200 bg-neutral-100 text-xs font-semibold text-neutral-600">
                                                {{ strtoupper(substr($category->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <p class="font-medium text-neutral-950">{{ $category->name }}</p>
                                                <p class="text-xs text-neutral-500">{{ $category->card_label }}</p>
                                                <p class="mt-1 font-mono text-xs text-neutral-500">/{{ $category->slug }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex flex-wrap gap-2">
                                            <span class="inline-flex rounded-full border border-neutral-200 bg-neutral-50 px-2 py-1 text-xs text-neutral-600">{{ count($category->card_features ?? []) }} card features</span>
                                            <span class="inline-flex rounded-full border border-neutral-200 bg-neutral-50 px-2 py-1 text-xs text-neutral-600">{{ count($category->stats ?? []) }} stats</span>
                                            <span class="inline-flex rounded-full border border-neutral-200 bg-neutral-50 px-2 py-1 text-xs text-neutral-600">{{ count($category->subcategories ?? []) }} subcategories</span>
                                            <span class="inline-flex rounded-full border border-neutral-200 bg-neutral-50 px-2 py-1 text-xs text-neutral-600">{{ count($category->gallery_products ?? []) }} products</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <span class="inline-flex rounded-full border px-2 py-1 text-xs font-medium {{ $category->is_published ? 'border-neutral-300 bg-neutral-100 text-neutral-950' : 'border-neutral-300 bg-white text-neutral-500' }}">
                                            {{ $category->is_published ? 'Published' : 'Draft' }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-right">{{ $category->sort_order }}</td>
                                    <td class="px-4 py-4 text-right">
                                        <a href="{{ route('admin.categories.edit', $category) }}" class="inline-flex items-center justify-center rounded-md border border-neutral-300 bg-white px-3 py-2 text-xs font-semibold text-neutral-700 transition hover:border-black hover:text-black">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
