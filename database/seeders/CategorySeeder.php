<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->categories() as $category) {
            Category::query()->updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function categories(): array
    {
        return [
            $this->teamUniforms(),
            $this->teamApparel(),
            $this->fanMerchandise(),
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private function teamUniforms(): array
    {
        return [
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
            'card_image' => null,
            'hero_badge' => 'Bulk Category Page',
            'hero_title' => 'Custom Team',
            'hero_highlight' => 'Uniforms',
            'hero_description' => 'Built for clubs, schools, distributors, and private-label buyers who need custom teamwear in bulk. This page is designed to convert inquiry-led customers, not retail product shoppers.',
            'hero_image' => 'images/hero-slider/01.jpeg',
            'stats' => [
                ['value' => 'Low MOQ', 'label' => 'Flexible Bulk Programs'],
                ['value' => 'OEM', 'label' => 'Private Label Ready'],
                ['value' => '2 Weeks', 'label' => 'Production Lead Time'],
                ['value' => 'Global', 'label' => 'Wholesale Fulfillment'],
            ],
            'overview_eyebrow' => 'Category Overview',
            'overview_title' => 'Team Uniform Manufacturing For Buyers Who Need Reliable Reorders',
            'overview_paragraphs' => [
                'This category page is built for bulk-order customers. Instead of pushing individual products, it presents the category as a manufacturing capability with clear sub-category coverage, production depth, and visual proof of output quality.',
                'Troopers Sports manufactures full custom team uniform programs for clubs, schools, academies, retailers, and private-label brands. Buyers can use this page to understand the available sub-categories, branding methods, and the breadth of styles available before starting a quote request.',
                'Every order can be tailored around sport, fit, fabric, branding method, and reorder strategy. That makes this page more useful for lead generation than a conventional retail category grid.',
            ],
            'best_fit_eyebrow' => 'Best Fit For',
            'best_fit_items' => [
                ['title' => 'Sports Clubs & Academies', 'description' => 'Seasonal uniform programs, age-group sizing, and sponsor-ready branding.'],
                ['title' => 'Retailers & Distributors', 'description' => 'Margin-focused wholesale production with stable quality across repeat orders.'],
                ['title' => 'Private Label Brands', 'description' => 'OEM teamwear backed by labeling, packaging, and category expansion support.'],
            ],
            'subcategory_eyebrow' => 'Sub Categories',
            'subcategory_title' => 'Teamwear Product Range',
            'subcategory_description' => 'This dedicated sub-category section helps bulk buyers understand the range inside the main category before they request pricing, sampling, or MOQ guidance.',
            'subcategories' => $this->teamUniformSubcategories(),
            'gallery_eyebrow' => 'Category Gallery',
            'gallery_title' => 'Visual Direction For This Category',
            'gallery_description' => 'Use this gallery block to showcase representative items from the category and help bulk buyers quickly understand style range, branding flexibility, and finish level.',
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
            'inquiry_description' => 'This page is intentionally designed to move visitors toward a quote request. It explains category breadth, shows visual proof, and keeps the next step focused on inquiry rather than checkout.',
            'quote_button_label' => 'Get A Category Quote',
            'whatsapp_button_label' => 'Message The Factory Team',
            'seo_title' => 'Custom Team Uniforms - Bulk Manufacturing by Troopers Sports',
            'seo_description' => 'Explore bulk custom team uniform manufacturing with sub-categories, construction details, branding options, and gallery inspiration for clubs, brands, and distributors.',
            'sort_order' => 1,
            'is_published' => true,
        ];
    }

    /**
     * @return array<int, array<string, string>>
     */
    private function teamUniformSubcategories(): array
    {
        return [
            ['title' => 'Basketball', 'description' => 'Custom basketball uniforms for clubs, academies, school teams, and distributors that need performance sets in bulk.', 'details' => 'Jerseys, shorts, reversible kits, player names and numbering.'],
            ['title' => 'Football', 'description' => 'American football uniforms and practice apparel produced for structured team programs with consistent sizing and branding control.', 'details' => 'Game jerseys, practice tops, sideline apparel, sponsor-ready customization.'],
            ['title' => 'Baseball', 'description' => 'Baseball teamwear designed for clubs and suppliers who need custom cuts, durable trims, and repeat-ready production.', 'details' => 'Button jerseys, pants, training tops, embroidery and twill options.'],
            ['title' => 'Softball', 'description' => 'Softball uniforms built for schools, leagues, and wholesale buyers looking for coordinated team programs.', 'details' => 'Women\'s fits, game uniforms, training pieces, consistent club branding.'],
            ['title' => 'Soccer', 'description' => 'Bulk custom soccer kits manufactured for clubs, academies, tour operators, and private-label teamwear brands.', 'details' => 'Match kits, training sets, tracksuits, sponsor placements, numbering.'],
            ['title' => 'Volleyball', 'description' => 'Volleyball uniforms developed for indoor and beach team programs with lightweight fabrics and sharp branding execution.', 'details' => 'Jerseys, shorts, warm-ups, women\'s and youth size runs.'],
            ['title' => 'Flag Football', 'description' => 'Flag football apparel made for tournament organizers, clubs, schools, and resellers needing custom team sets in volume.', 'details' => 'Lightweight jerseys, coordinated shorts, names, numbers, logo applications.'],
            ['title' => 'Cheerleading', 'description' => 'Cheerleading uniforms and team apparel produced for schools, studios, and organizations that need polished visual presentation.', 'details' => 'Performance sets, warm-ups, layering pieces, team identity branding.'],
            ['title' => 'Cricket', 'description' => 'Cricket uniforms engineered for clubs, schools, and distributors who require clean finishes, reliable reorders, and team customization.', 'details' => 'Match shirts, trousers, training kits, sponsor branding, size continuity.'],
            ['title' => 'Lacrosse', 'description' => 'Custom lacrosse uniforms built for team programs that need breathable fabrics, durable construction, and flexible design execution.', 'details' => 'Game jerseys, shorts, pinnies, training layers, numbering systems.'],
            ['title' => 'Ice Hockey', 'description' => 'Ice hockey jerseys and supporting teamwear manufactured for clubs and brands needing bulk custom production with strong visual consistency.', 'details' => 'Game jerseys, training tops, twill details, sponsor-safe layouts.'],
            ['title' => 'Field Hockey', 'description' => 'Field hockey kits tailored for school and club programs that want coordinated teamwear with repeatable quality.', 'details' => 'Match uniforms, skorts, shorts, warm-up apparel, custom numbering.'],
            ['title' => 'Track', 'description' => 'Track and athletics teamwear for schools, clubs, and event programs requiring lightweight construction and multi-item package consistency.', 'details' => 'Singlets, shorts, warm-ups, relay kits, club branding systems.'],
            ['title' => 'Rugby', 'description' => 'Rugby uniforms produced for clubs and retailers needing durable garments, strong seam integrity, and bold team branding.', 'details' => 'Match jerseys, shorts, training tops, sponsor integration, size grading.'],
            ['title' => 'Bowling', 'description' => 'Custom bowling shirts and team apparel for leagues, clubs, and promotional programs ordering in bulk.', 'details' => 'Button shirts, polos, sublimation artwork, team and sponsor identities.'],
            ['title' => 'Wrestling', 'description' => 'Wrestling teamwear programs built for schools, academies, and clubs that need consistent fit and competition-ready output.', 'details' => 'Singlets, warm-up suits, compression layers, custom club branding.'],
            ['title' => 'Cycling', 'description' => 'Cycling apparel manufactured for clubs, event teams, and brand programs that need technical garments in bulk.', 'details' => 'Jerseys, bib shorts, gilets, race-day graphics, coordinated collections.'],
            ['title' => 'Tennis', 'description' => 'Tennis team apparel created for academies, clubs, and tournament programs seeking polished customization and dependable repeat orders.', 'details' => 'Match polos, skirts, shorts, warm-up layers, private-label finishing.'],
            ['title' => 'Golf', 'description' => 'Golf team and corporate apparel produced for clubs, schools, and premium programs where presentation quality matters.', 'details' => 'Polos, quarter-zips, outerwear, embroidery, event-ready branding.'],
            ['title' => 'Esports', 'description' => 'Esports jerseys and lifestyle teamwear designed for organizations, creators, and brands building a recognizable identity in bulk.', 'details' => 'Competition jerseys, hoodies, creator merch, private-label options.'],
            ['title' => 'Ultimate Frisbee', 'description' => 'Ultimate frisbee uniforms manufactured for clubs and tournament programs that need lightweight kits and fast brand execution.', 'details' => 'Game jerseys, shorts, pinnies, travel apparel, consistent team graphics.'],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private function teamApparel(): array
    {
        return $this->categoryFromTemplate(
            slug: 'team-apparel',
            cardLabel: 'Apparel',
            name: 'Custom Team Apparel',
            summary: 'Off-field and training apparel engineered for comfort, fit consistency, and repeat-season reorders.',
            cardFeatures: [
                'Polos, hoodies, jackets, training tees',
                'Performance and fleece material options',
                'Private label and retail-ready finishing',
            ],
            heroImage: 'images/hero-slider/06.jpeg',
            subcategoryTitle: 'Team Apparel Product Range',
            subcategories: [
                ['title' => 'Training Tees', 'description' => 'Lightweight training tops for clubs, academies, and retail teamwear programs.', 'details' => 'Performance knits, sublimation, screen print, size grading.'],
                ['title' => 'Hoodies & Fleece', 'description' => 'Warm team layers for travel, sideline use, and supporter ranges.', 'details' => 'Pullover hoodies, zip hoodies, fleece sets, labels.'],
                ['title' => 'Polos & Jackets', 'description' => 'Presentation apparel for staff, clubs, events, and sponsors.', 'details' => 'Embroidery, woven labels, retail-ready trims.'],
            ],
            gallery: [
                ['name' => 'Team Apparel & Hoodies', 'image' => 'images/hero-slider/06.jpeg'],
                ['name' => 'Soccer & Polo Teamwear', 'image' => 'images/hero-slider/02.jpeg'],
                ['name' => 'Baseball Warmup Apparel', 'image' => 'images/hero-slider/04.jpeg'],
            ],
            sortOrder: 2,
        );
    }

    /**
     * @return array<string, mixed>
     */
    private function fanMerchandise(): array
    {
        return $this->categoryFromTemplate(
            slug: 'club-fan-merchandise',
            cardLabel: 'Merch',
            name: 'Club & Fan Merchandise',
            summary: 'Supporter and community merchandise for clubs, schools, and events with controlled quality at scale.',
            cardFeatures: [
                'Beanies, scarves, hats, promo products',
                'Sponsor-ready artwork placement',
                'Bulk and seasonal reorder planning',
            ],
            heroImage: 'images/hero-slider/03.jpeg',
            subcategoryTitle: 'Merchandise Product Range',
            subcategories: [
                ['title' => 'Supporter Apparel', 'description' => 'Fan-facing tees, hoodies, and lifestyle pieces for clubs and events.', 'details' => 'Screen print, embroidery, private label finishing.'],
                ['title' => 'Accessories', 'description' => 'Coordinated accessories that extend the team merchandise range.', 'details' => 'Caps, scarves, beanies, gloves, bags.'],
                ['title' => 'Event Merchandise', 'description' => 'Seasonal and tournament merchandise programs produced in bulk.', 'details' => 'Sponsor artwork, packaging, reorder planning.'],
            ],
            gallery: [
                ['name' => 'Custom Sports Gloves', 'image' => 'images/hero-slider/03.jpeg'],
                ['name' => 'Team Apparel & Hoodies', 'image' => 'images/hero-slider/06.jpeg'],
                ['name' => 'American Football Fan Gear', 'image' => 'images/hero-slider/01.jpeg'],
            ],
            sortOrder: 3,
        );
    }

    /**
     * @param  array<int, string>  $cardFeatures
     * @param  array<int, array<string, string>>  $subcategories
     * @param  array<int, array<string, string>>  $gallery
     * @return array<string, mixed>
     */
    private function categoryFromTemplate(
        string $slug,
        string $cardLabel,
        string $name,
        string $summary,
        array $cardFeatures,
        string $heroImage,
        string $subcategoryTitle,
        array $subcategories,
        array $gallery,
        int $sortOrder,
    ): array {
        return [
            'slug' => $slug,
            'card_label' => $cardLabel,
            'name' => $name,
            'title' => $name,
            'summary' => $summary,
            'card_features' => $cardFeatures,
            'card_cta_label' => 'View '.str_replace('Custom ', '', $name).' Detail Page',
            'card_image' => null,
            'hero_badge' => 'Bulk Category Page',
            'hero_title' => $name,
            'hero_highlight' => null,
            'hero_description' => $summary.' This page is designed for bulk-order customers who need clear production guidance before requesting a quote.',
            'hero_image' => $heroImage,
            'stats' => [
                ['value' => 'Low MOQ', 'label' => 'Flexible Bulk Programs'],
                ['value' => 'OEM', 'label' => 'Private Label Ready'],
                ['value' => '2 Weeks', 'label' => 'Production Lead Time'],
                ['value' => 'Global', 'label' => 'Wholesale Fulfillment'],
            ],
            'overview_eyebrow' => 'Category Overview',
            'overview_title' => $name.' Manufacturing For Repeat Bulk Buyers',
            'overview_paragraphs' => [
                'This category page presents the product group as a manufacturing capability, with production depth, visual direction, and clear buying context.',
                'Troopers Sports supports clubs, schools, retailers, distributors, and private-label brands that need consistent sizing, dependable finishing, and repeatable bulk programs.',
                'Each order can be tailored around fabric, fit, trims, branding method, packaging, and reorder strategy.',
            ],
            'best_fit_eyebrow' => 'Best Fit For',
            'best_fit_items' => [
                ['title' => 'Clubs & Schools', 'description' => 'Seasonal programs, club identity systems, and organized reorder support.'],
                ['title' => 'Retailers & Distributors', 'description' => 'Margin-focused production with stable quality across repeat orders.'],
                ['title' => 'Private Label Brands', 'description' => 'OEM manufacturing backed by labeling, packaging, and product range support.'],
            ],
            'subcategory_eyebrow' => 'Sub Categories',
            'subcategory_title' => $subcategoryTitle,
            'subcategory_description' => 'This section helps bulk buyers understand the available product range before they request pricing, sampling, or MOQ guidance.',
            'subcategories' => $subcategories,
            'gallery_eyebrow' => 'Sample Gallery',
            'gallery_title' => 'Sample Image Direction For This Item Category',
            'gallery_description' => 'Use this gallery to review representative product direction, branding flexibility, and finish level.',
            'gallery_products' => $gallery,
            'inquiry_eyebrow' => 'Inquiry First',
            'inquiry_title' => 'Turn This Category Into A Bulk Order Conversation',
            'inquiry_description' => 'This page is intentionally designed to move visitors toward a quote request with clear category breadth and visual proof.',
            'quote_button_label' => 'Get A Category Quote',
            'whatsapp_button_label' => 'Message The Factory Team',
            'seo_title' => $name.' - Bulk Manufacturing by Troopers Sports',
            'seo_description' => $summary,
            'sort_order' => $sortOrder,
            'is_published' => true,
        ];
    }
}
