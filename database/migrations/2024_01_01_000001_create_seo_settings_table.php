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
        Schema::create('seo_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_title', 100)->nullable();
            $table->string('site_description', 255)->nullable();
            $table->string('site_keywords', 255)->nullable();
            $table->string('og_title', 100)->nullable();
            $table->string('og_description', 255)->nullable();
            $table->string('og_image', 255)->nullable();
            $table->string('twitter_card', 100)->nullable();
            $table->string('twitter_site', 100)->nullable();
            $table->string('google_analytics_id', 100)->nullable();
            $table->string('meta_robots', 100)->nullable();
            $table->text('schema_markup')->nullable();
            $table->text('custom_head_tags')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seo_settings');
    }
}; 