<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        return view('admin.categories.index', [
            'categories' => Category::query()->ordered()->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.categories.create', [
            'category' => new Category,
        ]);
    }

    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $category = Category::query()->create($request->categoryPayload());

        return redirect()
            ->route('admin.categories.edit', $category)
            ->with('status', 'Category created successfully.');
    }

    public function edit(Category $category): View
    {
        return view('admin.categories.edit', [
            'category' => $category,
        ]);
    }

    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        $category->update($request->categoryPayload($category));

        return redirect()
            ->route('admin.categories.edit', $category)
            ->with('status', 'Category updated successfully.');
    }
}
