<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('page_contents', function (Blueprint $table) {
            $table->longText('content')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Mengambil semua data dari tabel page_contents
        $contents = DB::table('page_contents')->get();
        
        // Mengubah data yang bukan JSON menjadi JSON valid
        foreach ($contents as $content) {
            $jsonContent = json_encode(['html' => $content->content]);
            DB::table('page_contents')
                ->where('id', $content->id)
                ->update(['content' => $jsonContent]);
        }
        
        // Setelah data diubah, ubah kolom menjadi JSON
        Schema::table('page_contents', function (Blueprint $table) {
            $table->json('content')->change();
        });
    }
};
