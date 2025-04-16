<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeoSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('seo_settings')->insert([
            'site_title' => 'ZDX Cargo - Jasa Pengiriman Terpercaya',
            'site_description' => 'ZDX Cargo menyediakan jasa pengiriman barang cepat, aman, dan terpercaya ke seluruh Indonesia dengan tarif kompetitif.',
            'site_keywords' => 'cargo, pengiriman barang, ekspedisi, logistik, jasa pengiriman',
            'og_title' => 'ZDX Cargo - Layanan Pengiriman Terpercaya',
            'og_description' => 'Jasa pengiriman cepat, aman dan terpercaya untuk kebutuhan logistik Anda',
            'og_image' => 'images/og/zdx-og-image.jpg',
            'twitter_card' => 'summary_large_image',
            'twitter_site' => 'zdxcargo',
            'google_analytics_id' => 'G-XXXXXXXXXX',
            'meta_robots' => 'index, follow',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
} 