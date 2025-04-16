<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'route' => '',
                'title' => 'Beranda',
                'description' => 'ZDX Cargo - Solusi pengiriman barang terpercaya untuk bisnis dan kebutuhan pribadi Anda. Layanan pengiriman darat, laut, dan udara yang cepat dan aman.',
                'keywords' => 'jasa pengiriman, cargo darat, pengiriman laut, cargo udara, ekspedisi',
                'og_title' => 'ZDX Cargo - Layanan Pengiriman Terpercaya',
                'og_description' => 'Jasa pengiriman cepat, aman dan terpercaya untuk kebutuhan logistik Anda',
                'is_indexed' => true,
                'is_followed' => true,
            ],
            [
                'route' => 'services',
                'title' => 'Layanan',
                'description' => 'Berbagai layanan pengiriman ZDX Cargo: darat, laut, dan udara. Pengiriman cepat, aman, dan terjangkau untuk kebutuhan Anda.',
                'keywords' => 'layanan pengiriman, cargo darat, cargo laut, cargo udara, ekspedisi',
                'og_title' => 'Layanan Pengiriman ZDX Cargo',
                'og_description' => 'Solusi pengiriman lengkap: darat, laut, dan udara dengan jangkauan nasional & internasional',
                'is_indexed' => true,
                'is_followed' => true,
            ],
            [
                'route' => 'rates',
                'title' => 'Tarif',
                'description' => 'Cek tarif pengiriman ZDX Cargo yang kompetitif untuk berbagai layanan pengiriman darat, laut, dan udara ke berbagai kota di Indonesia.',
                'keywords' => 'tarif pengiriman, harga cargo, ongkos kirim, cek ongkir',
                'og_title' => 'Tarif Pengiriman ZDX Cargo',
                'og_description' => 'Tarif pengiriman terjangkau dengan layanan terbaik untuk seluruh Indonesia',
                'is_indexed' => true,
                'is_followed' => true,
            ],
            [
                'route' => 'tracking',
                'title' => 'Tracking',
                'description' => 'Lacak status pengiriman barang Anda secara realtime dengan sistem tracking ZDX Cargo yang mudah dan akurat.',
                'keywords' => 'lacak pengiriman, tracking cargo, cek status kiriman, tracking online',
                'og_title' => 'Tracking Pengiriman ZDX Cargo',
                'og_description' => 'Lacak pengiriman Anda secara real-time dengan sistem tracking yang akurat',
                'is_indexed' => true,
                'is_followed' => true,
            ],
            [
                'route' => 'customer',
                'title' => 'Customer',
                'description' => 'Menjadi mitra ZDX Cargo dan nikmati berbagai kemudahan dalam layanan pengiriman. Pelayanan khusus untuk customer korporat.',
                'keywords' => 'customer cargo, layanan pelanggan, corporate account, mitra bisnis',
                'og_title' => 'Program Pelanggan ZDX Cargo',
                'og_description' => 'Keuntungan menjadi pelanggan tetap ZDX Cargo dengan berbagai promo menarik',
                'is_indexed' => true,
                'is_followed' => true,
            ],
            [
                'route' => 'profile',
                'title' => 'Profil',
                'description' => 'Profil ZDX Cargo sebagai penyedia jasa pengiriman terpercaya di Indonesia dengan layanan yang handal dan berpengalaman.',
                'keywords' => 'profil perusahaan, tentang kami, visi misi cargo, sejarah perusahaan',
                'og_title' => 'Profil ZDX Cargo',
                'og_description' => 'Mengenal lebih dekat ZDX Cargo, penyedia jasa pengiriman terpercaya di Indonesia',
                'is_indexed' => true,
                'is_followed' => true,
            ],
            [
                'route' => 'contact',
                'title' => 'Kontak',
                'description' => 'Hubungi ZDX Cargo untuk kebutuhan pengiriman Anda. Layanan pelanggan 24/7 dengan respons cepat untuk semua kebutuhan cargo Anda.',
                'keywords' => 'kontak cargo, layanan pelanggan, hubungi kami, customer service',
                'og_title' => 'Hubungi ZDX Cargo',
                'og_description' => 'Hubungi kami untuk berbagai kebutuhan logistik Anda. Layanan pelanggan 24/7',
                'is_indexed' => true,
                'is_followed' => true,
            ],
        ];

        foreach ($pages as $page) {
            DB::table('page_seos')->insert([
                'route' => $page['route'],
                'title' => $page['title'],
                'description' => $page['description'],
                'keywords' => $page['keywords'],
                'og_title' => $page['og_title'],
                'og_description' => $page['og_description'],
                'is_indexed' => $page['is_indexed'],
                'is_followed' => $page['is_followed'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
} 