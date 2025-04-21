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
        // Tambahkan kontak telepon kedua dan ketiga
        $this->createSetting('company_phone2', '', 'company');
        $this->createSetting('company_phone3', '', 'company');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hapus kontak telepon kedua dan ketiga
        DB::table('settings')->where('key', 'company_phone2')->delete();
        DB::table('settings')->where('key', 'company_phone3')->delete();
    }

    /**
     * Buat setting jika belum ada
     */
    private function createSetting($key, $value, $group)
    {
        if (!DB::table('settings')->where('key', $key)->exists()) {
            DB::table('settings')->insert([
                'key' => $key,
                'value' => $value,
                'group' => $group,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
};
