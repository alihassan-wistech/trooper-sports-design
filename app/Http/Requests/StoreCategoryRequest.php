<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'slug' => ['required', 'string', 'max:120', $this->uniqueSlugRule()],
            'card_label' => ['required', 'string', 'max:120'],
            'name' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'summary' => ['required', 'string', 'max:5000'],
            'card_features' => ['nullable', 'array'],
            'card_features.*' => ['nullable', 'string', 'max:255'],
            'card_cta_label' => ['required', 'string', 'max:255'],
            'card_image' => ['nullable', 'string', 'max:255'],
            'card_image_upload' => ['nullable', 'image', 'max:4096'],
            'hero_badge' => ['required', 'string', 'max:255'],
            'hero_title' => ['required', 'string', 'max:255'],
            'hero_highlight' => ['nullable', 'string', 'max:255'],
            'hero_description' => ['required', 'string', 'max:5000'],
            'hero_image' => ['nullable', 'string', 'max:255'],
            'hero_image_upload' => ['nullable', 'image', 'max:4096'],
            'stats' => ['nullable', 'array'],
            'stats.*' => ['array:value,label'],
            'stats.*.value' => ['nullable', 'string', 'max:120'],
            'stats.*.label' => ['nullable', 'string', 'max:255'],
            'overview_eyebrow' => ['required', 'string', 'max:255'],
            'overview_title' => ['required', 'string', 'max:255'],
            'overview_paragraphs' => ['nullable', 'array'],
            'overview_paragraphs.*' => ['nullable', 'string', 'max:5000'],
            'best_fit_eyebrow' => ['required', 'string', 'max:255'],
            'best_fit_items' => ['nullable', 'array'],
            'best_fit_items.*' => ['array:title,description'],
            'best_fit_items.*.title' => ['nullable', 'string', 'max:255'],
            'best_fit_items.*.description' => ['nullable', 'string', 'max:5000'],
            'subcategory_eyebrow' => ['required', 'string', 'max:255'],
            'subcategory_title' => ['required', 'string', 'max:255'],
            'subcategory_description' => ['required', 'string', 'max:5000'],
            'subcategories' => ['nullable', 'array'],
            'subcategories.*' => ['array:title,description,details'],
            'subcategories.*.title' => ['nullable', 'string', 'max:255'],
            'subcategories.*.description' => ['nullable', 'string', 'max:5000'],
            'subcategories.*.details' => ['nullable', 'string', 'max:5000'],
            'gallery_eyebrow' => ['required', 'string', 'max:255'],
            'gallery_title' => ['required', 'string', 'max:255'],
            'gallery_description' => ['required', 'string', 'max:5000'],
            'gallery_products' => ['nullable', 'array'],
            'gallery_products.*' => ['array:name,image'],
            'gallery_products.*.name' => ['nullable', 'string', 'max:255'],
            'gallery_products.*.image' => ['nullable', 'string', 'max:255'],
            'gallery_product_images' => ['nullable', 'array'],
            'gallery_product_images.*' => ['nullable', 'image', 'max:4096'],
            'inquiry_eyebrow' => ['required', 'string', 'max:255'],
            'inquiry_title' => ['required', 'string', 'max:255'],
            'inquiry_description' => ['required', 'string', 'max:5000'],
            'quote_button_label' => ['required', 'string', 'max:255'],
            'whatsapp_button_label' => ['required', 'string', 'max:255'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:5000'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'is_published' => ['nullable', 'boolean'],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function categoryPayload(?Category $category = null): array
    {
        $validated = $this->validated();

        $validated['card_features'] = $this->filledStrings($validated['card_features'] ?? []);
        $validated['overview_paragraphs'] = $this->filledStrings($validated['overview_paragraphs'] ?? []);
        $validated['stats'] = $this->filledRows($validated['stats'] ?? [], ['value', 'label']);
        $validated['best_fit_items'] = $this->filledRows($validated['best_fit_items'] ?? [], ['title', 'description']);
        $validated['subcategories'] = $this->filledRows($validated['subcategories'] ?? [], ['title', 'description', 'details']);
        $validated['gallery_products'] = $this->filledRows($validated['gallery_products'] ?? [], ['name', 'image']);

        foreach (['card_image', 'hero_highlight', 'hero_image', 'seo_title', 'seo_description'] as $field) {
            $validated[$field] = $this->nullableString($validated[$field] ?? null);
        }

        $validated['card_image'] = $this->uploadedImagePath(
            'card_image_upload',
            $validated['card_image'],
            $category?->card_image,
        );
        $validated['hero_image'] = $this->uploadedImagePath(
            'hero_image_upload',
            $validated['hero_image'],
            $category?->hero_image,
        );
        $validated['gallery_products'] = $this->galleryProductsWithUploadedImages(
            $validated['gallery_products'],
            $category?->gallery_products ?? [],
        );

        unset($validated['card_image_upload'], $validated['hero_image_upload'], $validated['gallery_product_images']);

        $validated['is_published'] = $this->boolean('is_published');

        return $validated;
    }

    protected function uniqueSlugRule(): Unique
    {
        return Rule::unique('categories', 'slug');
    }

    /**
     * @param  array<int, mixed>  $values
     * @return array<int, string>
     */
    private function filledStrings(array $values): array
    {
        return collect($values)
            ->map(fn (mixed $value): string => trim((string) $value))
            ->filter(fn (string $value): bool => $value !== '')
            ->values()
            ->all();
    }

    /**
     * @param  array<int, mixed>  $rows
     * @param  array<int, string>  $keys
     * @return array<int, array<string, string>>
     */
    private function filledRows(array $rows, array $keys): array
    {
        return collect($rows)
            ->map(function (mixed $row) use ($keys): array {
                $row = is_array($row) ? $row : [];

                return collect($keys)
                    ->mapWithKeys(fn (string $key): array => [$key => trim((string) ($row[$key] ?? ''))])
                    ->all();
            })
            ->filter(fn (array $row): bool => collect($row)->contains(fn (string $value): bool => $value !== ''))
            ->values()
            ->all();
    }

    private function nullableString(?string $value): ?string
    {
        $value = trim((string) $value);

        return $value === '' ? null : $value;
    }

    private function uploadedImagePath(string $field, ?string $currentPath, ?string $previousPath): ?string
    {
        $file = $this->file($field);

        if (! $file instanceof UploadedFile) {
            return $currentPath;
        }

        $this->deleteManagedUpload($previousPath);

        return $this->storePublicImage($file);
    }

    /**
     * @param  array<int, array<string, string>>  $products
     * @param  array<int, mixed>  $previousProducts
     * @return array<int, array<string, string>>
     */
    private function galleryProductsWithUploadedImages(array $products, array $previousProducts): array
    {
        $files = $this->file('gallery_product_images', []);

        foreach ($products as $index => $product) {
            $file = $files[$index] ?? null;

            if (! $file instanceof UploadedFile) {
                continue;
            }

            $previousImage = is_array($previousProducts[$index] ?? null)
                ? ($previousProducts[$index]['image'] ?? null)
                : null;

            $this->deleteManagedUpload($previousImage);

            $products[$index]['image'] = $this->storePublicImage($file);
        }

        return $products;
    }

    private function storePublicImage(UploadedFile $file): string
    {
        $directory = 'uploads/category-images';
        $extension = $file->extension() ?: $file->getClientOriginalExtension() ?: 'jpg';
        $filename = Str::uuid().'.'.$extension;

        File::ensureDirectoryExists(public_path($directory));

        $file->move(public_path($directory), $filename);

        return $directory.'/'.$filename;
    }

    private function deleteManagedUpload(?string $path): void
    {
        if (! is_string($path) || ! Str::startsWith($path, 'uploads/category-images/')) {
            return;
        }

        File::delete(public_path($path));
    }
}
