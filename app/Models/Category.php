<?php

namespace App\Models;

use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /** @use HasFactory<CategoryFactory> */
    use HasFactory;

    protected $fillable = [
        'slug',
        'card_label',
        'name',
        'title',
        'summary',
        'card_features',
        'card_cta_label',
        'card_image',
        'hero_badge',
        'hero_title',
        'hero_highlight',
        'hero_description',
        'hero_image',
        'stats',
        'overview_eyebrow',
        'overview_title',
        'overview_paragraphs',
        'best_fit_eyebrow',
        'best_fit_items',
        'subcategory_eyebrow',
        'subcategory_title',
        'subcategory_description',
        'subcategories',
        'gallery_eyebrow',
        'gallery_title',
        'gallery_description',
        'gallery_products',
        'inquiry_eyebrow',
        'inquiry_title',
        'inquiry_description',
        'quote_button_label',
        'whatsapp_button_label',
        'seo_title',
        'seo_description',
        'sort_order',
        'is_published',
    ];

    protected $attributes = [
        'card_cta_label' => 'View Detail Page',
        'hero_badge' => 'Bulk Category Page',
        'overview_eyebrow' => 'Category Overview',
        'best_fit_eyebrow' => 'Best Fit For',
        'subcategory_eyebrow' => 'Sub Categories',
        'gallery_eyebrow' => 'Category Gallery',
        'inquiry_eyebrow' => 'Inquiry First',
        'quote_button_label' => 'Get A Category Quote',
        'whatsapp_button_label' => 'Message The Factory Team',
        'sort_order' => 0,
        'is_published' => true,
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    protected function casts(): array
    {
        return [
            'card_features' => 'array',
            'stats' => 'array',
            'overview_paragraphs' => 'array',
            'best_fit_items' => 'array',
            'subcategories' => 'array',
            'gallery_products' => 'array',
            'sort_order' => 'integer',
            'is_published' => 'boolean',
        ];
    }
}
