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
        Schema::create('page_seo_settings', function (Blueprint $table) {
            $table->id();
            $table->string('page_identifier', 50)->unique();
            $table->string('page_name', 100);
            $table->string('title', 100)->nullable();
            $table->text('description')->nullable();
            $table->string('keywords', 255)->nullable();
            $table->string('og_title', 100)->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image', 255)->nullable();
            $table->string('custom_robots', 100)->nullable();
            $table->text('custom_schema')->nullable();
            $table->boolean('uses_global_settings')->default(false);
            $table->string('focus_keyword', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_seo_settings');
    }
}; 