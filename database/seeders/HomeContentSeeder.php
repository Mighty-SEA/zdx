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
            
            // 3. Layanan
            [
                'section_name' => 'Layanan',
                'section_key' => 'services',
                'title' => 'Layanan Kami',
                'subtitle' => 'Kami menyediakan berbagai layanan pengiriman yang dirancang untuk memenuhi kebutuhan logistik Anda',
                'order' => 3,
                'is_active' => true,
                'use_rich_editor' => false,
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
            
            // 5. Layanan Card
            [
                'section_name' => 'Layanan Card',
                'section_key' => 'service_cards',
                'title' => 'Kargo Darat',
                'subtitle' => 'Layanan pengiriman darat dengan armada yang lengkap dan terpercaya',
                'content' => '<p>Kami menyediakan layanan kargo darat yang efisien dengan jangkauan seluruh Indonesia. Armada kami dilengkapi dengan sistem tracking yang memudahkan Anda memantau pengiriman.</p>',
                'button_text' => 'Selengkapnya',
                'button_url' => '/layanan/kargo-darat',
                'order' => 5,
                'is_active' => true,
                'use_rich_editor' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // 6. Partner
            [
                'section_name' => 'Partner',
                'section_key' => 'partners',
                'title' => 'Dipercaya oleh Perusahaan Terkemuka',
                'subtitle' => 'Perusahaan dan brand yang telah mempercayakan pengiriman mereka kepada kami',
                'order' => 6,
                'is_active' => true,
                'use_rich_editor' => false,
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