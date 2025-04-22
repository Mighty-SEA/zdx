<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Membuat key "company_address2" dan "company_address3" di tabel settings
        Setting::setValue('company_address2', '', 'company');
        Setting::setValue('company_address3', '', 'company');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hapus setting dengan key company_address2 dan company_address3
        $setting2 = Setting::where('key', 'company_address2')->first();
        if ($setting2) {
            $setting2->delete();
        }
        
        $setting3 = Setting::where('key', 'company_address3')->first();
        if ($setting3) {
            $setting3->delete();
        }
    }
};
