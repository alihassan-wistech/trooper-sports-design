<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class UpdateCategoryRequest extends StoreCategoryRequest
{
    protected function uniqueSlugRule(): Unique
    {
        $category = $this->route('category');

        return Rule::unique('categories', 'slug')->ignore($category);
    }
}
