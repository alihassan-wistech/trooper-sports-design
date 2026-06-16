<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_homepage_renders_hero_slider_background_images(): void
    {
        $html = view('frontend.home', [
            'seoTitle' => 'Troopers Sports',
            'seoMetaDescription' => 'Factory-direct sportswear',
            'seoSchemaJson' => null,
            'injectedHeaderScripts' => null,
            'injectedFooterScripts' => null,
            'categoryCards' => collect([$this->teamUniformsCategory()]),
        ])->render();

        $this->assertStringContainsString('/images/hero-slider/01.jpeg', $html);
        $this->assertStringContainsString('/images/hero-slider/02.jpeg', $html);
        $this->assertStringContainsString('/images/hero-slider/03.jpeg', $html);
        $this->assertStringContainsString('/images/hero-slider/04.jpeg', $html);
        $this->assertStringContainsString('/images/hero-slider/05.jpeg', $html);
        $this->assertStringContainsString('/images/hero-slider/06.jpeg', $html);
        $this->assertStringContainsString('/images/hero-slider/07.jpeg', $html);
        $this->assertSame(7, substr_count($html, 'class="swiper-slide relative"'));
        $this->assertStringContainsString('linear-gradient(100deg, rgba(0, 0, 0, 0.88) 0%, rgba(0, 0, 0, 0.78) 34%, rgba(0, 0, 0, 0.46) 62%, rgba(0, 0, 0, 0.14) 82%, rgba(0, 0, 0, 0.03) 100%)', $html);
        $this->assertStringContainsString('href="https://wa.me/923418649479" class="btn btn-outline-light btn-md"', $html);
        $this->assertStringContainsString('What We Offer', $html);
        $this->assertStringContainsString('Cut &amp; Sew Customization', $html);
        $this->assertStringContainsString('Heat Transfer &amp; Vinyl Printing', $html);
        $this->assertStringContainsString('Private Labeling &amp; Branding', $html);
        $this->assertStringContainsString('/images/what-we-offer/1.png', $html);
        $this->assertStringContainsString('/images/what-we-offer/6.png', $html);
        $this->assertStringContainsString(route('categories.team-uniforms'), $html);
        $this->assertStringContainsString('background-color: #000000 !important;', $html);
        $this->assertStringContainsString('background-color: #f5f5f5 !important;', $html);
        $this->assertStringContainsString('color: #262626 !important;', $html);
        $this->assertStringNotContainsString('Image Placeholder', $html);
    }

    public function test_frontend_layout_hides_admin_topbar_for_guests(): void
    {
        $html = view('frontend.home', $this->frontendViewPayload())->render();

        $this->assertStringNotContainsString('Admin mode', $html);
        $this->assertStringNotContainsString(route('admin.categories.index'), $html);
    }

    public function test_frontend_layout_shows_admin_topbar_for_authenticated_users(): void
    {
        $this->actingAs(User::factory()->make(['name' => 'Admin User']));

        $html = view('frontend.home', $this->frontendViewPayload())->render();

        $this->assertStringContainsString('Admin mode', $html);
        $this->assertStringContainsString('Admin User', $html);
        $this->assertStringContainsString(route('dashboard'), $html);
        $this->assertStringContainsString(route('admin.categories.index'), $html);
        $this->assertStringContainsString(route('logout'), $html);
    }

    public function test_the_team_uniforms_category_page_renders_bulk_buyer_content(): void
    {
        $html = view('frontend.team-uniforms', [
            'category' => $this->teamUniformsCategory(),
            'seoTitle' => 'Custom Team Uniforms – Troopers Sports',
            'seoMetaDescription' => 'Bulk team uniform manufacturing',
            'seoSchemaJson' => null,
            'injectedHeaderScripts' => null,
            'injectedFooterScripts' => null,
        ])->render();

        $this->assertStringContainsString('Custom Team Uniforms', $html);
        $this->assertStringContainsString('Bulk Category Page', $html);
        $this->assertStringContainsString('This dedicated sub-category section helps bulk buyers understand the range inside the main category', $html);
        $this->assertStringContainsString('Basketball', $html);
        $this->assertStringContainsString('Football', $html);
        $this->assertStringContainsString('Cricket', $html);
        $this->assertStringContainsString('Esports', $html);
        $this->assertStringContainsString('Ultimate Frisbee', $html);
        $this->assertStringContainsString('/images/hero-slider/01.jpeg', $html);
        $this->assertStringContainsString('/images/hero-slider/06.jpeg', $html);
        $this->assertStringContainsString('American Football Uniforms', $html);
        $this->assertStringContainsString('Soccer &amp; Polo Teamwear', $html);
        $this->assertStringContainsString('Custom Sports Gloves', $html);
        $this->assertStringContainsString('Team Apparel &amp; Hoodies', $html);
        $this->assertStringContainsString('productCount: 6', $html);
        $this->assertStringContainsString('x-on:click="openLightbox(0)"', $html);
        $this->assertStringContainsString('id="product-gallery-lightbox"', $html);
        $this->assertStringContainsString('aria-label="Product image gallery"', $html);
        $this->assertStringNotContainsString('Category Item 01', $html);
        $this->assertStringContainsString('REQUEST BULK QUOTE', $html);
        $this->assertStringContainsString('ASK ABOUT THIS CATEGORY', $html);
    }

    private function teamUniformsCategory(): Category
    {
        return Category::factory()->make([
            'slug' => 'team-uniforms',
            'card_label' => 'Team Wear',
            'name' => 'Custom Team Uniforms',
            'title' => 'Custom Team Uniforms',
            'summary' => 'Built for match-day performance with sport-specific cuts, panel mapping, and durable branding methods.',
            'card_features' => [
                'AFL, basketball, cricket, soccer, rugby',
                'Game jerseys, shorts, warm-up sets',
                'Sublimation, embroidery, heat transfer',
            ],
            'card_cta_label' => 'View Uniform Detail Page',
            'hero_badge' => 'Bulk Category Page',
            'hero_title' => 'Custom Team',
            'hero_highlight' => 'Uniforms',
            'hero_description' => 'Built for clubs, schools, distributors, and private-label buyers who need custom teamwear in bulk.',
            'hero_image' => 'images/hero-slider/01.jpeg',
            'stats' => [
                ['value' => 'Low MOQ', 'label' => 'Flexible Bulk Programs'],
                ['value' => 'OEM', 'label' => 'Private Label Ready'],
            ],
            'overview_eyebrow' => 'Category Overview',
            'overview_title' => 'Team Uniform Manufacturing For Buyers Who Need Reliable Reorders',
            'overview_paragraphs' => [
                'This category page is built for bulk-order customers.',
            ],
            'best_fit_eyebrow' => 'Best Fit For',
            'best_fit_items' => [
                ['title' => 'Sports Clubs & Academies', 'description' => 'Seasonal uniform programs.'],
            ],
            'subcategory_eyebrow' => 'Sub Categories',
            'subcategory_title' => 'Built To Cover Every Layer Of A Teamwear Program',
            'subcategory_description' => 'This dedicated sub-category section helps bulk buyers understand the range inside the main category before they request pricing, sampling, or MOQ guidance.',
            'subcategories' => [
                ['title' => 'Basketball', 'description' => 'Custom basketball uniforms for clubs.', 'details' => 'Jerseys and shorts.'],
                ['title' => 'Football', 'description' => 'American football uniforms.', 'details' => 'Game jerseys.'],
                ['title' => 'Cricket', 'description' => 'Cricket uniforms.', 'details' => 'Match shirts.'],
                ['title' => 'Esports', 'description' => 'Esports jerseys.', 'details' => 'Competition jerseys.'],
                ['title' => 'Ultimate Frisbee', 'description' => 'Ultimate frisbee uniforms.', 'details' => 'Game jerseys.'],
            ],
            'gallery_eyebrow' => 'Category Gallery',
            'gallery_title' => 'Visual Direction For This Category',
            'gallery_description' => 'Use this gallery block to showcase representative items from the category.',
            'gallery_products' => [
                ['name' => 'American Football Uniforms', 'image' => 'images/hero-slider/01.jpeg'],
                ['name' => 'Soccer & Polo Teamwear', 'image' => 'images/hero-slider/02.jpeg'],
                ['name' => 'Custom Sports Gloves', 'image' => 'images/hero-slider/03.jpeg'],
                ['name' => 'Baseball Uniforms', 'image' => 'images/hero-slider/04.jpeg'],
                ['name' => 'Basketball Uniforms', 'image' => 'images/hero-slider/05.jpeg'],
                ['name' => 'Team Apparel & Hoodies', 'image' => 'images/hero-slider/06.jpeg'],
            ],
            'inquiry_eyebrow' => 'Inquiry First',
            'inquiry_title' => 'Turn This Category Into A Bulk Order Conversation',
            'inquiry_description' => 'This page is intentionally designed to move visitors toward a quote request.',
            'quote_button_label' => 'Request Bulk Quote',
            'whatsapp_button_label' => 'Ask About This Category',
            'is_published' => true,
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    private function frontendViewPayload(): array
    {
        return [
            'seoTitle' => 'Troopers Sports',
            'seoMetaDescription' => 'Factory-direct sportswear',
            'seoSchemaJson' => null,
            'injectedHeaderScripts' => null,
            'injectedFooterScripts' => null,
            'categoryCards' => collect([$this->teamUniformsCategory()]),
        ];
    }
}
