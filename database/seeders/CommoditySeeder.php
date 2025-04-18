<?php

namespace Database\Seeders;

use App\Models\Commodity;
use Illuminate\Database\Seeder;

class CommoditySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $commodities = [
            [
                'name' => 'General Cargo',
                'description' => 'Barang umum seperti dokumen, pakaian, peralatan rumah tangga, dan barang-barang ringan lainnya. Dilayani dengan pengiriman cepat dan aman.',
                'image_url' => 'https://images.unsplash.com/photo-1577705998148-6da4f3963bc8?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            ],
            [
                'name' => 'Electronics',
                'description' => 'Barang-barang elektronik seperti laptop, smartphone, alat rumah tangga elektronik, dan perangkat IT. Ditangani dengan prosedur khusus dan extra protection.',
                'image_url' => 'https://images.unsplash.com/photo-1550009158-9ebf69173e03?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            ],
            [
                'name' => 'Valuable Cargo',
                'description' => 'Barang bernilai tinggi seperti perhiasan, dokumen penting, atau barang branded eksklusif. Ditangani dengan keamanan ekstra dan asuransi khusus.',
                'image_url' => 'https://images.unsplash.com/photo-1607344645866-009c320b63e0?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            ],
            [
                'name' => 'Frozen Food',
                'description' => 'Makanan beku seperti daging, ikan, nugget, dan produk olahan lainnya. Ditransportasikan menggunakan armada berpendingin khusus.',
                'image_url' => 'https://images.unsplash.com/photo-1624806992066-5ffcacead90d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            ],
            [
                'name' => 'FMCG',
                'description' => 'Produk konsumsi cepat seperti makanan ringan, minuman, produk kecantikan, dan kebutuhan sehari-hari. Ditangani dengan sistem distribusi efisien.',
                'image_url' => 'https://images.unsplash.com/photo-1607082349566-187342175e2f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            ],
            [
                'name' => 'Dangerous Goods',
                'description' => 'Bahan kimia, gas, atau cairan berbahaya yang memerlukan izin dan perlakuan khusus. Ditangani oleh tim berpengalaman dengan sertifikasi DG.',
                'image_url' => 'https://images.unsplash.com/photo-1635513748158-b0c0a8ad0b83?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            ],
            [
                'name' => 'Heavy Cargo',
                'description' => 'Barang berat seperti mesin, spare part industri, atau material konstruksi. Ditangani dengan peralatan khusus dan armada yang sesuai.',
                'image_url' => 'https://images.unsplash.com/photo-1586528116493-ce4c9d733638?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            ],
            [
                'name' => 'Animal Live',
                'description' => 'Pengiriman hewan hidup yang memerlukan sertifikasi khusus dan perawatan selama perjalanan. Dilengkapi petugas yang terlatih menangani hewan.',
                'image_url' => 'https://images.unsplash.com/photo-1517849845537-4d257902454a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            ],
        ];

        foreach ($commodities as $commodity) {
            Commodity::create($commodity);
        }
    }
} 