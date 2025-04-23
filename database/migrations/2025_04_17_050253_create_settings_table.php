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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('group')->default('general');
            $table->string('title_logo_path')->nullable();
            $table->timestamps();
        });

        // Tambahkan kontak telepon kedua dan ketiga
        $this->createSetting('company_phone_cs1', '', 'company');
        $this->createSetting('company_phone_cs2', '', 'company');
        
        // Tambahkan nama customer service
        $this->createSetting('cs_name1', '', 'company');
        $this->createSetting('cs_name2', '', 'company');
        
        // Tambahkan alamat tambahan
        $this->createSetting('company_address2', '', 'company');
        $this->createSetting('company_address3', '', 'company');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }

    /**
     * Buat setting jika belum ada
     */
    private function createSetting($key, $value, $group)
    {
        DB::table('settings')->insert([
            'key' => $key,
            'value' => $value,
            'group' => $group,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
};
