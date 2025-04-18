<?php

namespace Database\Seeders;

use App\Models\PageContent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Home Page - Hero Section
        PageContent::updateOrCreate(
            ['page_key' => 'home', 'section' => 'hero'],
            [
                'title' => 'Solusi Pengiriman',
                'subtitle' => 'Cepat & Terpercaya',
                'content' => 'Kirim barang Anda ke seluruh Indonesia dengan layanan ekspres yang aman dan tepat waktu',
                'extra_data' => json_encode([
                    'cta_tracking_text' => 'Lacak Pengiriman',
                    'cta_tarif_text' => 'Cek Tarif'
                ]),
                'is_active' => true,
                'order' => 1
            ]
        );

        // Home Page - Stats Section
        PageContent::updateOrCreate(
            ['page_key' => 'home', 'section' => 'stats'],
            [
                'title' => 'Statistik Kami',
                'subtitle' => '',
                'content' => '',
                'extra_data' => json_encode([
                    'stats' => [
                        ['label' => 'Partner', 'value' => '10000+'],
                        ['label' => 'Project', 'value' => '100+'],
                        ['label' => 'Success', 'value' => '24/7'],
                        ['label' => 'Country', 'value' => '99%']
                    ]
                ]),
                'is_active' => true,
                'order' => 2
            ]
        );

        // About Page - Main Section
        PageContent::updateOrCreate(
            ['page_key' => 'about', 'section' => 'main'],
            [
                'title' => 'Tentang ZDX Express',
                'subtitle' => 'Pengiriman terpercaya sejak 2005',
                'content' => '<p>ZDX Express adalah penyedia jasa logistik terkemuka di Indonesia yang berfokus pada pengiriman cepat dan aman ke seluruh wilayah Indonesia.</p><p>Dengan pengalaman lebih dari 15 tahun dalam industri pengiriman, kami berkomitmen untuk memberikan layanan terbaik bagi pelanggan kami.</p>',
                'extra_data' => json_encode([
                    'vision' => 'Menjadi perusahaan logistik terdepan dengan jaringan terluas di Indonesia',
                    'mission' => 'Memberikan layanan pengiriman yang cepat, aman, dan terpercaya dengan harga yang kompetitif'
                ]),
                'is_active' => true,
                'order' => 1
            ]
        );

        // Services Page - Main Section
        PageContent::updateOrCreate(
            ['page_key' => 'services', 'section' => 'main'],
            [
                'title' => 'Layanan Kami',
                'subtitle' => 'Pengiriman untuk berbagai kebutuhan',
                'content' => '<p>ZDX Express menyediakan berbagai layanan pengiriman yang dapat disesuaikan dengan kebutuhan Anda, baik untuk pengiriman dokumen, paket, ataupun kargo dengan berat dan ukuran yang bervariasi.</p>',
                'extra_data' => null,
                'is_active' => true,
                'order' => 1
            ]
        );
    }
}
