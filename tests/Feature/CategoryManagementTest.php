<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Database\Seeders\CategorySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class CategoryManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_seeded_categories_render_as_homepage_cards_with_dynamic_links(): void
    {
        $this->seed(CategorySeeder::class);

        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertSee('Custom Team Uniforms')
            ->assertSee('Custom Team Apparel')
            ->assertSee('Club &amp; Fan Merchandise', false)
            ->assertSee(route('categories.show', Category::query()->where('slug', 'team-apparel')->firstOrFail()), false)
            ->assertSee(route('categories.show', Category::query()->where('slug', 'club-fan-merchandise')->firstOrFail()), false);
    }

    public function test_seeded_category_detail_page_uses_database_content(): void
    {
        $this->seed(CategorySeeder::class);

        $response = $this->get('/categories/team-apparel');

        $response
            ->assertOk()
            ->assertSee('Custom Team Apparel')
            ->assertSee('Team Apparel Product Range')
            ->assertSee('Training Tees')
            ->assertSee('Team Apparel &amp; Hoodies', false)
            ->assertDontSee('Built To Cover Every Layer Of This Product Program')
            ->assertSee('productCount: 3', false)
            ->assertSee('id="product-gallery-lightbox"', false);
    }

    public function test_admin_can_create_and_update_a_category(): void
    {
        $admin = User::factory()->create();

        $this->actingAs($admin)
            ->post(route('admin.categories.store'), $this->validCategoryPayload([
                'slug' => 'custom-training-wear',
                'name' => 'Custom Training Wear',
                'title' => 'Custom Training Wear',
            ]))
            ->assertRedirect(route('admin.categories.edit', Category::query()->where('slug', 'custom-training-wear')->firstOrFail()));

        $category = Category::query()->where('slug', 'custom-training-wear')->firstOrFail();

        $this->assertSame(['Training tees', 'Warm-up jackets'], $category->card_features);
        $this->assertTrue($category->is_published);

        $this->actingAs($admin)
            ->patch(route('admin.categories.update', $category), $this->validCategoryPayload([
                'slug' => 'custom-training-wear',
                'name' => 'Updated Training Wear',
                'title' => 'Updated Training Wear',
                'is_published' => '0',
            ]))
            ->assertRedirect(route('admin.categories.edit', $category->fresh()));

        $category->refresh();

        $this->assertSame('Updated Training Wear', $category->name);
        $this->assertFalse($category->is_published);
    }

    public function test_admin_category_form_uses_repeatable_content_controls_instead_of_json_fields(): void
    {
        $admin = User::factory()->create();

        $this->actingAs($admin)
            ->get(route('admin.categories.create'))
            ->assertOk()
            ->assertSee('Basics')
            ->assertSee('Homepage Card')
            ->assertSee('Hero &amp; Stats', false)
            ->assertSee('Detail Content')
            ->assertSee('Gallery')
            ->assertSee('Inquiry')
            ->assertSee('SEO')
            ->assertSee('Add Feature')
            ->assertSee('Add Stat')
            ->assertSee('Add Paragraph')
            ->assertSee('Add Subcategory')
            ->assertSee('Add Product')
            ->assertDontSee('Card Features JSON')
            ->assertDontSee('Stats JSON')
            ->assertDontSee('Gallery Products JSON')
            ->assertDontSee('Card Image Path')
            ->assertDontSee('Hero Image Path')
            ->assertDontSee('name="card_features"', false);
    }

    public function test_admin_category_index_has_status_tabs_search_and_content_summaries(): void
    {
        $admin = User::factory()->create();

        Category::factory()->create([
            'name' => 'Published Category',
            'slug' => 'published-category',
            'is_published' => true,
            'card_features' => ['Feature one', 'Feature two'],
            'stats' => [
                ['value' => 'Low MOQ', 'label' => 'Flexible Programs'],
            ],
            'subcategories' => [
                ['title' => 'Training Tees', 'description' => 'Lightweight tees.', 'details' => 'Print and sublimation'],
            ],
            'gallery_products' => [
                ['name' => 'Training Tee', 'image' => 'images/hero-slider/02.jpeg'],
            ],
        ]);

        Category::factory()->create([
            'name' => 'Draft Category',
            'slug' => 'draft-category',
            'is_published' => false,
        ]);

        $this->actingAs($admin)
            ->get(route('admin.categories.index'))
            ->assertOk()
            ->assertSee('Search name, slug, label')
            ->assertSee('Published')
            ->assertSee('Drafts')
            ->assertSee('2 card features')
            ->assertSee('1 stats')
            ->assertSee('1 subcategories')
            ->assertSee('1 products');
    }

    public function test_admin_category_array_fields_drop_empty_rows(): void
    {
        $admin = User::factory()->create();

        $this->actingAs($admin)
            ->post(route('admin.categories.store'), $this->validCategoryPayload([
                'slug' => 'trimmed-category',
                'card_features' => ['Training tees', ''],
                'stats' => [
                    ['value' => 'Low MOQ', 'label' => 'Flexible Programs'],
                    ['value' => '', 'label' => ''],
                ],
                'gallery_products' => [
                    ['name' => 'Training Tee', 'image' => 'images/hero-slider/02.jpeg'],
                    ['name' => '', 'image' => ''],
                ],
            ]))
            ->assertRedirect();

        $category = Category::query()->where('slug', 'trimmed-category')->firstOrFail();

        $this->assertSame(['Training tees'], $category->card_features);
        $this->assertSame([['value' => 'Low MOQ', 'label' => 'Flexible Programs']], $category->stats);
        $this->assertSame([['name' => 'Training Tee', 'image' => 'images/hero-slider/02.jpeg']], $category->gallery_products);
    }

    public function test_admin_can_upload_category_images(): void
    {
        $admin = User::factory()->create();

        $this->actingAs($admin)
            ->post(route('admin.categories.store'), $this->validCategoryPayload([
                'slug' => 'uploaded-category',
                'card_image' => '',
                'card_image_upload' => $this->fakePngUpload('card.png'),
                'hero_image' => '',
                'hero_image_upload' => $this->fakePngUpload('hero.png'),
                'gallery_products' => [
                    ['name' => 'Training Tee', 'image' => ''],
                ],
                'gallery_product_images' => [
                    $this->fakePngUpload('gallery.png'),
                ],
            ]))
            ->assertRedirect();

        $category = Category::query()->where('slug', 'uploaded-category')->firstOrFail();

        $this->assertStringStartsWith('uploads/category-images/', $category->card_image);
        $this->assertStringStartsWith('uploads/category-images/', $category->hero_image);
        $this->assertStringStartsWith('uploads/category-images/', $category->gallery_products[0]['image']);

        $uploadedPaths = [
            $category->card_image,
            $category->hero_image,
            $category->gallery_products[0]['image'],
        ];

        foreach ($uploadedPaths as $uploadedPath) {
            $this->assertFileExists(public_path($uploadedPath));
            File::delete(public_path($uploadedPath));
        }
    }

    /**
     * @param  array<string, mixed>  $overrides
     * @return array<string, mixed>
     */
    private function validCategoryPayload(array $overrides = []): array
    {
        return array_replace([
            'slug' => 'sample-category',
            'card_label' => 'Training',
            'name' => 'Sample Category',
            'title' => 'Sample Category',
            'summary' => 'A sample category summary for bulk buyers.',
            'card_features' => ['Training tees', 'Warm-up jackets'],
            'card_cta_label' => 'View Detail Page',
            'card_image' => '',
            'hero_badge' => 'Bulk Category Page',
            'hero_title' => 'Sample Category',
            'hero_highlight' => '',
            'hero_description' => 'Sample hero description for buyers.',
            'hero_image' => 'images/hero-slider/01.jpeg',
            'stats' => [
                ['value' => 'Low MOQ', 'label' => 'Flexible Programs'],
            ],
            'overview_eyebrow' => 'Category Overview',
            'overview_title' => 'Sample Category Overview',
            'overview_paragraphs' => ['Sample overview paragraph.'],
            'best_fit_eyebrow' => 'Best Fit For',
            'best_fit_items' => [
                ['title' => 'Clubs', 'description' => 'Built for clubs.'],
            ],
            'subcategory_eyebrow' => 'Sub Categories',
            'subcategory_title' => 'Sample Sub Categories',
            'subcategory_description' => 'Sample subcategory description.',
            'subcategories' => [
                ['title' => 'Training Tees', 'description' => 'Lightweight tees.', 'details' => 'Sublimation and print.'],
            ],
            'gallery_eyebrow' => 'Sample Gallery',
            'gallery_title' => 'Sample Gallery Title',
            'gallery_description' => 'Sample gallery description.',
            'gallery_products' => [
                ['name' => 'Training Tee', 'image' => 'images/hero-slider/02.jpeg'],
            ],
            'inquiry_eyebrow' => 'Inquiry First',
            'inquiry_title' => 'Start A Bulk Order',
            'inquiry_description' => 'Sample inquiry description.',
            'quote_button_label' => 'Get A Quote',
            'whatsapp_button_label' => 'Chat On WhatsApp',
            'seo_title' => '',
            'seo_description' => '',
            'sort_order' => '1',
            'is_published' => '1',
        ], $overrides);
    }

    private function fakePngUpload(string $name): UploadedFile
    {
        return UploadedFile::fake()->createWithContent(
            $name,
            base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+/p9sAAAAASUVORK5CYII='),
        );
    }
}
