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
        Schema::create('page_contents', function (Blueprint $table) {
            $table->id();
            $table->string('page_identifier', 100);
            $table->string('section_identifier', 100);
            $table->string('content_type', 50)->default('text'); // text, html, json, dll
            $table->json('content')->nullable();
            $table->foreignId('last_edited_by')->nullable()->constrained('users');
            $table->timestamp('last_edited_at')->nullable();
            $table->timestamps();
            
            $table->unique(['page_identifier', 'section_identifier']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_contents');
    }
};
