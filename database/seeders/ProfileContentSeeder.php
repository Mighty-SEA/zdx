<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data yang sudah ada (opsional)
        DB::table('profile_contents')->truncate();

        $sections = [
            [
                'section' => 'about',
                'title' => 'Tentang Kami',
                'content' => '<p>PT. ZINDAN DIANTAR EXPRESS (ZDX) merupakan perusahaan yang didirikan pada tanggal 10 April 2023 
                            dan mulai beroperasi di tahun 2023. Meski terbilang baru, PT. ZDX sudah memiliki berbagai pengalaman 
                            dalam bidang jasa pengiriman barang melalui darat, laut dan udara.</p>
                            <p>PT. ZDX memiliki service pengiriman Door to Door (Home Service) & Port to Port (Airport Service) 
                            dengan harga yang bersaing, pelayanan yang baik, dan kecepatan pengiriman.</p>
                            <p>PT. ZDX mulai beroperasional secara mandiri dengan bisnis utama pengiriman barang via udara, 
                            dan juga perusahaan yang independen, dalam arti kata bahwa bukan merupakan perusahaan yang terafiliasi 
                            atau bukan merupakan anak perusahaan dari suatu group.</p>',
                'order' => 1,
                'is_active' => true
            ],
            [
                'section' => 'vision',
                'title' => 'Visi',
                'content' => '<p>Menjadi perusahaan terbaik dan terpercaya dalam bidang jasa pengiriman barang diwilayah Indonesia 
                        dengan memberikan jasa layanan yang berkualitas dan terpercaya.</p>',
                'order' => 2,
                'is_active' => true
            ],
            [
                'section' => 'mission',
                'title' => 'Misi',
                'content' => '<p>Peningkatan jasa layanan dan sumber daya (Manusia, metode, teknologi, infrastruktur) secara berkesinambungan, 
                        sekaligus memperluas jaringan kerja dengan dukungan tenaga-tenaga ahli dibidangnya profesional dan 
                        berpengalaman serta bertanggung jawab.</p>',
                'order' => 3,
                'is_active' => true
            ],
            [
                'section' => 'service_darat',
                'title' => 'Zindan Diantar Express Darat',
                'content' => '<p>Metode pengiriman melalui transportasi darat dengan jaringan yang luas dan armada yang handal.</p>',
                'order' => 4,
                'is_active' => true
            ],
            [
                'section' => 'service_laut',
                'title' => 'Zindan Diantar Express Laut',
                'content' => '<p>Metode pengiriman melalui transportasi laut untuk pengiriman antar pulau dengan biaya yang efisien.</p>',
                'order' => 5,
                'is_active' => true
            ],
            [
                'section' => 'service_udara',
                'title' => 'Zindan Diantar Express Udara',
                'content' => '<p>Metode pengiriman melalui transportasi udara untuk pengiriman cepat dan aman ke seluruh wilayah Indonesia.</p>',
                'order' => 6,
                'is_active' => true
            ]
        ];

        $now = now();
        
        foreach ($sections as $section) {
            $section['created_at'] = $now;
            $section['updated_at'] = $now;
            DB::table('profile_contents')->insert($section);
        }
    }
} 