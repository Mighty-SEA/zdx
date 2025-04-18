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
        if (!Schema::hasTable('page_contents')) {
            Schema::create('page_contents', function (Blueprint $table) {
                $table->id();
                $table->string('page_key')->comment('Kunci halaman (home, about, dll)');
                $table->string('section')->comment('Bagian dari halaman (hero, stats, dll)');
                $table->string('title')->nullable()->comment('Judul konten');
                $table->string('subtitle')->nullable()->comment('Subjudul konten');
                $table->text('content')->nullable()->comment('Konten utama');
                $table->text('image')->nullable()->comment('Path gambar');
                $table->json('extra_data')->nullable()->comment('Data tambahan dalam format JSON');
                $table->boolean('is_active')->default(true)->comment('Status aktif konten');
                $table->integer('order')->default(0)->comment('Urutan tampilan');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_contents');
    }
};
