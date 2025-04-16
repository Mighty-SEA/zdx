<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeoSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'page_identifier' => 'home',
                'page_name' => 'Beranda',
                'title' => 'Beranda',
                'description' => 'ZDX Cargo - Solusi pengiriman barang terpercaya untuk bisnis dan kebutuhan pribadi Anda. Layanan pengiriman darat, laut, dan udara yang cepat dan aman.',
                'keywords' => 'jasa pengiriman, cargo darat, pengiriman laut, cargo udara, ekspedisi',
                'og_title' => 'ZDX Cargo - Layanan Pengiriman Terpercaya',
                'og_description' => 'Jasa pengiriman cepat, aman dan terpercaya untuk kebutuhan logistik Anda',
            ],
            [
                'page_identifier' => 'services',
                'page_name' => 'Layanan',
                'title' => 'Layanan',
                'description' => 'Berbagai layanan pengiriman ZDX Cargo: darat, laut, dan udara. Pengiriman cepat, aman, dan terjangkau untuk kebutuhan Anda.',
                'keywords' => 'layanan pengiriman, cargo darat, cargo laut, cargo udara, ekspedisi',
                'og_title' => 'Layanan Pengiriman ZDX Cargo',
                'og_description' => 'Solusi pengiriman lengkap: darat, laut, dan udara dengan jangkauan nasional & internasional',
            ],
            [
                'page_identifier' => 'rates',
                'page_name' => 'Tarif',
                'title' => 'Tarif',
                'description' => 'Cek tarif pengiriman ZDX Cargo yang kompetitif untuk berbagai layanan pengiriman darat, laut, dan udara ke berbagai kota di Indonesia.',
                'keywords' => 'tarif pengiriman, harga cargo, ongkos kirim, cek ongkir',
                'og_title' => 'Tarif Pengiriman ZDX Cargo',
                'og_description' => 'Tarif pengiriman terjangkau dengan layanan terbaik untuk seluruh Indonesia',
            ],
            [
                'page_identifier' => 'tracking',
                'page_name' => 'Tracking',
                'title' => 'Tracking',
                'description' => 'Lacak status pengiriman barang Anda secara realtime dengan sistem tracking ZDX Cargo yang mudah dan akurat.',
                'keywords' => 'lacak pengiriman, tracking cargo, cek status kiriman, tracking online',
                'og_title' => 'Tracking Pengiriman ZDX Cargo',
                'og_description' => 'Lacak pengiriman Anda secara real-time dengan sistem tracking yang akurat',
            ],
            [
                'page_identifier' => 'customer',
                'page_name' => 'Customer',
                'title' => 'Customer',
                'description' => 'Menjadi mitra ZDX Cargo dan nikmati berbagai kemudahan dalam layanan pengiriman. Pelayanan khusus untuk customer korporat.',
                'keywords' => 'customer cargo, layanan pelanggan, corporate account, mitra bisnis',
                'og_title' => 'Program Pelanggan ZDX Cargo',
                'og_description' => 'Keuntungan menjadi pelanggan tetap ZDX Cargo dengan berbagai promo menarik',
            ],
            [
                'page_identifier' => 'profile',
                'page_name' => 'Profil',
                'title' => 'Profil',
                'description' => 'Profil ZDX Cargo sebagai penyedia jasa pengiriman terpercaya di Indonesia dengan layanan yang handal dan berpengalaman.',
                'keywords' => 'profil perusahaan, tentang kami, visi misi cargo, sejarah perusahaan',
                'og_title' => 'Profil ZDX Cargo',
                'og_description' => 'Mengenal lebih dekat ZDX Cargo, penyedia jasa pengiriman terpercaya di Indonesia',
            ],
            [
                'page_identifier' => 'contact',
                'page_name' => 'Kontak',
                'title' => 'Kontak',
                'description' => 'Hubungi ZDX Cargo untuk kebutuhan pengiriman Anda. Layanan pelanggan 24/7 dengan respons cepat untuk semua kebutuhan cargo Anda.',
                'keywords' => 'kontak cargo, layanan pelanggan, hubungi kami, customer service',
                'og_title' => 'Hubungi ZDX Cargo',
                'og_description' => 'Hubungi kami untuk berbagai kebutuhan logistik Anda. Layanan pelanggan 24/7',
            ],
        ];

        foreach ($pages as $page) {
            DB::table('page_seo_settings')->insert([
                'page_identifier' => $page['page_identifier'],
                'page_name' => $page['page_name'],
                'title' => $page['title'],
                'description' => $page['description'],
                'keywords' => $page['keywords'],
                'og_title' => $page['og_title'],
                'og_description' => $page['og_description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
} 