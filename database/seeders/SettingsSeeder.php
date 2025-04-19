<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data Google Analytics
        $this->createSetting('google_analytics_property_id', '', 'analytics');
        
        // Data Perusahaan
        $this->createSetting('company_name', 'PT ZDX Cargo Indonesia', 'company');
        $this->createSetting('company_address', 'Jl. Gatot Subroto No. 123, Jakarta Selatan 12930', 'company');
        $this->createSetting('company_phone', '021-12345678', 'company');
        $this->createSetting('company_email', 'info@zdxcargo.com', 'company');
        $this->createSetting('company_tax_id', '01.234.567.8-901.000', 'company');
        $this->createSetting('company_description', 'ZDX Cargo adalah perusahaan jasa pengiriman terpercaya yang melayani kebutuhan logistik bisnis dan pribadi dengan jangkauan nasional dan internasional.', 'company');
        $this->createSetting('company_slogan', 'Solusi Tepat Pengiriman Cepat', 'company');
        
        // Data API
        $this->createSetting('api_key', '', 'api');
        $this->createSetting('api_enabled', false, 'api');
        $this->createSetting('webhook_url', '', 'api');
    }
    
    /**
     * Buat setting jika belum ada
     */
    private function createSetting($key, $value, $group)
    {
        if (!Setting::where('key', $key)->exists()) {
            Setting::create([
                'key' => $key,
                'value' => $value,
                'group' => $group
            ]);
        }
    }
}
