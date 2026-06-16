@extends('layouts.dashboard')

@section('title', 'Create Category · Admin')
@section('page-heading', 'Create Category')

@section('content')
    <x-dashboard.card title="New Item Category" subtitle="Create a homepage card and dynamic detail page.">
        @include('admin.categories.partials.form', [
            'category' => $category,
            'action' => route('admin.categories.store'),
            'method' => 'POST',
            'submitLabel' => 'Create Category',
        ])
    </x-dashboard.card>
@endsection
