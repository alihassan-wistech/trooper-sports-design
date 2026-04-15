<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoPageSetting;
use App\Models\SiteScriptSetting;
use Illuminate\Http\Request;

class SeoSettingsController extends Controller
{
    private const DEFAULT_PAGES = [
        ['page_key' => 'home', 'page_name' => 'Homepage'],
        ['page_key' => 'about', 'page_name' => 'About'],
        ['page_key' => 'contact', 'page_name' => 'Contact'],
    ];

    public function index()
    {
        foreach (self::DEFAULT_PAGES as $page) {
            SeoPageSetting::firstOrCreate(
                ['page_key' => $page['page_key']],
                ['page_name' => $page['page_name']]
            );
        }

        $pages = SeoPageSetting::query()->orderBy('page_name')->get();
        $scripts = SiteScriptSetting::query()->firstOrCreate(['setting_key' => 'default']);

        return view('admin.seo-settings', [
            'pages' => $pages,
            'scripts' => $scripts,
        ]);
    }

    public function updatePages(Request $request)
    {
        $validated = $request->validate([
            'pages' => ['required', 'array', 'min:1'],
            'pages.*.page_key' => ['required', 'string', 'max:100'],
            'pages.*.page_name' => ['required', 'string', 'max:255'],
            'pages.*.meta_title' => ['nullable', 'string', 'max:255'],
            'pages.*.meta_description' => ['nullable', 'string', 'max:5000'],
            'pages.*.schema_json' => ['nullable', 'string'],
            'new_page_key' => ['nullable', 'string', 'max:100'],
            'new_page_name' => ['nullable', 'string', 'max:255'],
        ]);

        foreach ($validated['pages'] as $index => $pageData) {
            $schemaJson = trim((string) ($pageData['schema_json'] ?? ''));

            if ($schemaJson === '') {
                continue;
            }

            json_decode($schemaJson, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                return back()
                    ->withErrors(["pages.$index.schema_json" => 'Schema JSON must be valid JSON.'])
                    ->withInput();
            }
        }

        foreach ($validated['pages'] as $pageData) {
            SeoPageSetting::query()->updateOrCreate(
                ['page_key' => $pageData['page_key']],
                [
                    'page_name' => $pageData['page_name'],
                    'meta_title' => $pageData['meta_title'] ?: null,
                    'meta_description' => $pageData['meta_description'] ?: null,
                    'schema_json' => $pageData['schema_json'] ?: null,
                ]
            );
        }

        $newPageKey = trim((string) ($validated['new_page_key'] ?? ''));
        $newPageName = trim((string) ($validated['new_page_name'] ?? ''));

        if ($newPageKey !== '' && $newPageName !== '') {
            SeoPageSetting::query()->firstOrCreate(
                ['page_key' => strtolower($newPageKey)],
                ['page_name' => $newPageName]
            );
        }

        return redirect()
            ->route('admin.seo-settings')
            ->with('status', 'SEO page settings updated successfully.');
    }

    public function updateScripts(Request $request)
    {
        $validated = $request->validate([
            'header_scripts' => ['nullable', 'string'],
            'footer_scripts' => ['nullable', 'string'],
        ]);

        SiteScriptSetting::query()->updateOrCreate(
            ['setting_key' => 'default'],
            [
                'header_scripts' => $validated['header_scripts'] ?: null,
                'footer_scripts' => $validated['footer_scripts'] ?: null,
            ]
        );

        return redirect()
            ->route('admin.seo-settings')
            ->with('status', 'Header and footer scripts updated successfully.');
    }
}

