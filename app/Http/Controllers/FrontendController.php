<?php

namespace App\Http\Controllers;

use App\Models\SeoPageSetting;
use App\Models\SiteScriptSetting;

class FrontendController extends Controller
{
    public function home()
    {
        return view('frontend.home', $this->buildSeoPayload(
            'home',
            'Troopers Sports – Premium Factory-Direct Custom Sportswear',
            'Troopers Sports creates premium factory-direct custom sportswear, fitness apparel, and team wear with reliable global delivery.'
        ));
    }

    public function about()
    {
        return view('frontend.about', $this->buildSeoPayload(
            'about',
            'About Troopers Sports',
            'Learn about Troopers Sports, our manufacturing process, capabilities, and commitment to premium custom sportswear.'
        ));
    }

    public function contact()
    {
        return view('frontend.contact', $this->buildSeoPayload(
            'contact',
            'Contact Troopers Sports',
            'Contact Troopers Sports for custom sportswear quotes, production planning, and global fulfillment support.'
        ));
    }

    public function teamUniforms()
    {
        return view('frontend.team-uniforms', $this->buildSeoPayload(
            'team-uniforms',
            'Custom Team Uniforms – Bulk Manufacturing by Troopers Sports',
            'Explore bulk custom team uniform manufacturing with sub-categories, construction details, branding options, and gallery inspiration for clubs, brands, and distributors.'
        ));
    }

    private function buildSeoPayload(string $pageKey, string $defaultTitle, string $defaultDescription): array
    {
        $pageSeo = SeoPageSetting::query()->where('page_key', $pageKey)->first();
        $scriptSettings = SiteScriptSetting::query()->where('setting_key', 'default')->first();
        $resolvedTitle = $pageSeo?->meta_title ?: $defaultTitle;
        $resolvedDescription = $pageSeo?->meta_description ?: $defaultDescription;
        $resolvedSchema = $pageSeo?->schema_json ?: $this->defaultSchemaJson($pageKey, $resolvedTitle, $resolvedDescription);

        return [
            'seoTitle' => $resolvedTitle,
            'seoMetaDescription' => $resolvedDescription,
            'seoSchemaJson' => $resolvedSchema,
            'injectedHeaderScripts' => $scriptSettings?->header_scripts,
            'injectedFooterScripts' => $scriptSettings?->footer_scripts,
        ];
    }

    private function defaultSchemaJson(string $pageKey, string $title, string $description): string
    {
        $url = match ($pageKey) {
            'home' => route('home'),
            'about' => route('about'),
            'contact' => route('contact'),
            'team-uniforms' => route('categories.team-uniforms'),
            default => url('/'.ltrim($pageKey, '/')),
        };

        return (string) json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'WebPage',
            'name' => $title,
            'description' => $description,
            'url' => $url,
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}
