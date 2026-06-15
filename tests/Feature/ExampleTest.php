<?php

namespace Tests\Feature;

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

    public function test_the_team_uniforms_category_page_renders_bulk_buyer_content(): void
    {
        $html = view('frontend.team-uniforms', [
            'seoTitle' => 'Custom Team Uniforms – Troopers Sports',
            'seoMetaDescription' => 'Bulk team uniform manufacturing',
            'seoSchemaJson' => null,
            'injectedHeaderScripts' => null,
            'injectedFooterScripts' => null,
        ])->render();

        $this->assertStringContainsString('Custom Team Uniforms', $html);
        $this->assertStringContainsString('Bulk Category Page', $html);
        $this->assertStringContainsString('Sub Categories', $html);
        $this->assertStringContainsString('This dedicated sub-category section helps bulk buyers understand the range inside the main category', $html);
        $this->assertStringContainsString('Basketball', $html);
        $this->assertStringContainsString('Football', $html);
        $this->assertStringContainsString('Cricket', $html);
        $this->assertStringContainsString('Esports', $html);
        $this->assertStringContainsString('Ultimate Frisbee', $html);
        $this->assertStringContainsString('/images/hero-slider/01.jpeg', $html);
        $this->assertStringContainsString('/images/hero-slider/06.jpeg', $html);
        $this->assertStringContainsString('REQUEST BULK QUOTE', $html);
        $this->assertStringContainsString('ASK ABOUT THIS CATEGORY', $html);
    }
}
