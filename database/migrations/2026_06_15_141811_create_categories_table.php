<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('card_label');
            $table->string('name');
            $table->string('title');
            $table->text('summary');
            $table->json('card_features')->nullable();
            $table->string('card_cta_label')->default('View Detail Page');
            $table->string('card_image')->nullable();
            $table->string('hero_badge')->default('Bulk Category Page');
            $table->string('hero_title');
            $table->string('hero_highlight')->nullable();
            $table->text('hero_description');
            $table->string('hero_image')->nullable();
            $table->json('stats')->nullable();
            $table->string('overview_eyebrow')->default('Category Overview');
            $table->string('overview_title');
            $table->json('overview_paragraphs')->nullable();
            $table->string('best_fit_eyebrow')->default('Best Fit For');
            $table->json('best_fit_items')->nullable();
            $table->string('subcategory_eyebrow')->default('Sub Categories');
            $table->string('subcategory_title');
            $table->text('subcategory_description');
            $table->json('subcategories')->nullable();
            $table->string('gallery_eyebrow')->default('Category Gallery');
            $table->string('gallery_title');
            $table->text('gallery_description');
            $table->json('gallery_products')->nullable();
            $table->string('inquiry_eyebrow')->default('Inquiry First');
            $table->string('inquiry_title');
            $table->text('inquiry_description');
            $table->string('quote_button_label')->default('Get A Category Quote');
            $table->string('whatsapp_button_label')->default('Message The Factory Team');
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->boolean('is_published')->default(true)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
