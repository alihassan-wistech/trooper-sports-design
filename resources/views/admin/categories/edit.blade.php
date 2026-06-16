@extends('layouts.dashboard')

@section('title', 'Edit Category · Admin')
@section('page-heading', 'Edit Category')

@section('content')
    <div class="space-y-6">
        @if (session('status'))
            <div class="rounded-lg border border-neutral-300 bg-neutral-100 px-4 py-3 text-sm text-neutral-950">
                {{ session('status') }}
            </div>
        @endif

        <x-dashboard.card title="{{ $category->name }}" subtitle="Update the homepage card and dynamic detail-page sections.">
            @include('admin.categories.partials.form', [
                'category' => $category,
                'action' => route('admin.categories.update', $category),
                'method' => 'PATCH',
                'submitLabel' => 'Save Category',
            ])
        </x-dashboard.card>
    </div>
@endsection
