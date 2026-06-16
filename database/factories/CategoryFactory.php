<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'slug' => fake()->unique()->slug(3),
            'card_label' => fake()->words(2, true),
            'name' => fake()->words(3, true),
            'title' => fake()->words(3, true),
            'summary' => fake()->sentence(14),
            'card_features' => [
                fake()->sentence(4),
                fake()->sentence(4),
                fake()->sentence(4),
            ],
            'card_cta_label' => 'View Detail Page',
            'card_image' => null,
            'hero_badge' => 'Bulk Category Page',
            'hero_title' => fake()->words(3, true),
            'hero_highlight' => null,
            'hero_description' => fake()->paragraph(),
            'hero_image' => 'images/hero-slider/01.jpeg',
            'stats' => [
                ['value' => 'Low MOQ', 'label' => 'Flexible Bulk Programs'],
                ['value' => 'OEM', 'label' => 'Private Label Ready'],
            ],
            'overview_eyebrow' => 'Category Overview',
            'overview_title' => fake()->sentence(6),
            'overview_paragraphs' => [
                fake()->paragraph(),
                fake()->paragraph(),
            ],
            'best_fit_eyebrow' => 'Best Fit For',
            'best_fit_items' => [
                ['title' => 'Clubs', 'description' => fake()->sentence(10)],
                ['title' => 'Retailers', 'description' => fake()->sentence(10)],
            ],
            'subcategory_eyebrow' => 'Sub Categories',
            'subcategory_title' => fake()->sentence(6),
            'subcategory_description' => fake()->sentence(14),
            'subcategories' => [
                ['title' => 'Sample Item', 'description' => fake()->sentence(10), 'details' => fake()->sentence(8)],
            ],
            'gallery_eyebrow' => 'Sample Gallery',
            'gallery_title' => fake()->sentence(5),
            'gallery_description' => fake()->sentence(14),
            'gallery_products' => [
                ['name' => 'Sample Product', 'image' => 'images/hero-slider/01.jpeg'],
            ],
            'inquiry_eyebrow' => 'Inquiry First',
            'inquiry_title' => fake()->sentence(6),
            'inquiry_description' => fake()->paragraph(),
            'quote_button_label' => 'Get A Category Quote',
            'whatsapp_button_label' => 'Message The Factory Team',
            'seo_title' => null,
            'seo_description' => null,
            'sort_order' => fake()->numberBetween(1, 100),
            'is_published' => true,
        ];
    }
}
