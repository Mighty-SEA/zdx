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
        // Hapus data yang tidak valid (opsional, hapus baris ini jika ingin mempertahankan semua data)
        // DB::table('page_contents')->whereRaw('JSON_VALID(content) = 0')->delete();
        
        // Ubah semua data menjadi JSON valid
        $contents = DB::table('page_contents')->get();
        
        foreach ($contents as $content) {
            // Jika konten sudah JSON
            if (is_array($content->content) || $this->isJson($content->content)) {
                continue;
            }
            
            // Jika konten bukan JSON, konversi menjadi JSON
            DB::table('page_contents')
                ->where('id', $content->id)
                ->update(['content' => $content->content]);
        }
        
        // Pastikan kolom content adalah LONGTEXT
        Schema::table('page_contents', function (Blueprint $table) {
            $table->longText('content')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Tidak ada rollback khusus, karena kita hanya memperbaiki data
    }
    
    /**
     * Check if a string is valid JSON
     */
    private function isJson($string) {
        if (!is_string($string)) {
            return false;
        }
        
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }
};
