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
        Schema::create('site_script_settings', function (Blueprint $table) {
            $table->id();
            $table->string('setting_key')->unique()->default('default');
            $table->longText('header_scripts')->nullable();
            $table->longText('footer_scripts')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_script_settings');
    }
};

