<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HomeContent;
use Illuminate\Support\Facades\DB;

class HomeContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data lama
        HomeContent::truncate();
        
        $sections = [
            // 1. Hero Section
            [
                'section_name' => 'Hero Section',
                'section_key' => 'hero',
                'title' => 'Solusi Pengiriman Cepat & Terpercaya',
                'subtitle' => 'Kirim barang Anda ke seluruh Indonesia dengan layanan ekspres yang aman dan tepat waktu',
                'button_text' => 'Lacak Pengiriman',
                'button_url' => '/tracking',
                'order' => 1,
                'is_active' => true,
                'use_rich_editor' => false,
                'metadata' => json_encode([
                    'button2_text' => 'Cek Tarif',
                    'button2_url' => '/tarif'
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // 2. Statistik
            [
                'section_name' => 'Statistik',
                'section_key' => 'stats',
                'order' => 2,
                'is_active' => true,
                'use_rich_editor' => false,
                'metadata' => json_encode([
                    'items' => [
                        [
                            'number' => '34',
                            'label' => 'PARTNER',
                            'symbol' => '',
                            'icon' => 'fas fa-users'
                        ],
                        [
                            'number' => '400',
                            'label' => 'PROJECT',
                            'symbol' => '',
                            'icon' => 'fas fa-chart-bar'
                        ],
                        [
                            'number' => '400',
                            'label' => 'SUCCESS',
                            'symbol' => '',
                            'icon' => 'fas fa-chart-line'
                        ],
                        [
                            'number' => '200',
                            'label' => 'COUNTRY',
                            'symbol' => '',
                            'icon' => 'fas fa-globe'
                        ]
                    ],
                    'background_color' => '#FFCC00' // Warna kuning sesuai gambar
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            
            // 4. Keunggulan (Mengapa Memilih Kami)
            [
                'section_name' => 'Keunggulan',
                'section_key' => 'features',
                'title' => 'Mengapa Memilih Kami?',
                'subtitle' => 'Keunggulan layanan kami yang memberikan nilai tambah untuk pengiriman Anda',
                'content' => '<p>ZDX menyediakan solusi logistik terbaik dengan komitmen untuk kualitas, keandalan, dan kepuasan pelanggan. Kami hadir untuk menjawab kebutuhan pengiriman Anda.</p>',
                'image_path' => null,
                'order' => 4,
                'is_active' => true,
                'use_rich_editor' => true,
                'metadata' => json_encode([
                    'on_time_text' => 'Pengiriman Tepat Waktu',
                    'on_time_percentage' => '98%'
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // 5. CTA Section
            [
                'section_name' => 'CTA Section',
                'section_key' => 'cta',
                'title' => 'Siap Mengirim Barang Anda?',
                'subtitle' => 'Dapatkan penawaran terbaik untuk pengiriman barang Anda dengan layanan berkualitas prima dan jangkauan luas.',
                'button_text' => 'Hubungi Kami',
                'button_url' => '/kontak',
                'order' => 5,
                'is_active' => true,
                'use_rich_editor' => false,
                'metadata' => json_encode([
                    'benefits' => [
                        'Tarif bersaing untuk semua jenis pengiriman',
                        'Konsultasi gratis untuk kebutuhan logistik',
                        'Jaminan kepuasan untuk setiap pengiriman'
                    ],
                    'button2_text' => 'Lacak Kiriman',
                    'button2_url' => '/tracking',
                    'image_path' => 'https://images.unsplash.com/photo-1566576721346-d4a3b4eaeb55'
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert data
        foreach ($sections as $section) {
            HomeContent::create($section);
        }
        
        $this->command->info('Home content sections seeded successfully!');
    }
} 