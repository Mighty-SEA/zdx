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
        Schema::table('services', function (Blueprint $table) {
            // Cek apakah kolom sudah ada sebelum ditambahkan
            if (!Schema::hasColumn('services', 'title')) {
                $table->string('title')->after('id');
            }
            
            if (!Schema::hasColumn('services', 'slug')) {
                $table->string('slug')->unique()->after('title');
            }
            
            if (!Schema::hasColumn('services', 'description')) {
                $table->text('description')->after('slug');
            }
            
            if (!Schema::hasColumn('services', 'content')) {
                $table->longText('content')->after('description');
            }
            
            if (!Schema::hasColumn('services', 'image')) {
                $table->string('image')->nullable()->after('content');
            }
            
            if (!Schema::hasColumn('services', 'status')) {
                $table->enum('status', ['draft', 'published'])->default('draft')->after('image');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['title', 'slug', 'description', 'content', 'image', 'status']);
        });
    }
};
