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
        Schema::create('visitor_events', function (Blueprint $table) {
            $table->id();
            $table->string('session_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable()->index();
            $table->string('country_code', 2)->nullable()->index();
            $table->string('country_name')->nullable()->index();
            $table->string('url', 512)->index();
            $table->string('referrer', 1024)->nullable();
            $table->string('source', 64)->default('Direct')->index();
            $table->text('user_agent')->nullable();
            $table->timestamp('visited_at')->index();
            $table->timestamps();

            $table->index(['visited_at', 'source']);
            $table->index(['visited_at', 'country_code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitor_events');
    }
};

