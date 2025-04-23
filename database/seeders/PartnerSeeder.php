<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $partners = [
            [
                'type' => 'partner',
                'name' => 'RANO CIPTA NUSALOG',
                'logo' => 'partners/logos/v1qtqvlguVEYBWjdWZK6oKMNF3MyD8PgxgIk1Mpq.png',
                'status' => 'active',
                'created_at' => '2025-04-23 02:21:57',
                'updated_at' => '2025-04-23 02:24:14',
            ],
            [
                'type' => 'partner',
                'name' => 'PT PANDARAN',
                'logo' => 'partners/logos/XJqxty4hT4jn28Y0ODq0ZB7ds8R2CbHGabUezpld.png',
                'status' => 'active',
                'created_at' => '2025-04-23 02:21:57',
                'updated_at' => '2025-04-23 02:24:25',
            ],
            [
                'type' => 'partner',
                'name' => 'ONGKIR EXPRESS',
                'logo' => 'partners/logos/WOnY5BpudRjRTmlzcNv214GxDfqvjzz0PeBLJc94.png',
                'status' => 'active',
                'created_at' => '2025-04-23 02:21:57',
                'updated_at' => '2025-04-23 02:24:33',
            ],
            [
                'type' => 'partner',
                'name' => 'S-LOG',
                'logo' => 'partners/logos/QcCZ0DFpf9gFsdqLHBoIrpvstD9tcVBEJOIBRX0y.png',
                'status' => 'active',
                'created_at' => '2025-04-23 02:21:57',
                'updated_at' => '2025-04-23 02:24:42',
            ],
            [
                'type' => 'partner',
                'name' => 'BERLY CARGO',
                'logo' => 'partners/logos/ouT3gc9MftU0CVSXIdNH7OR89C1Q8AxE0uI0QNR0.png',
                'status' => 'active',
                'created_at' => '2025-04-23 02:21:57',
                'updated_at' => '2025-04-23 02:24:52',
            ],
            [
                'type' => 'partner',
                'name' => 'PT BAHAGIA RIZKI SELARAS',
                'logo' => 'partners/logos/QkpyNnIjEqiLH6zlf7Y1jmn1BpPMYqz9qiDEX1cK.png',
                'status' => 'active',
                'created_at' => '2025-04-23 02:21:57',
                'updated_at' => '2025-04-23 02:25:02',
            ],
            [
                'type' => 'partner',
                'name' => 'EXPRESS & LOGISTICS',
                'logo' => 'partners/logos/XVnLgO3Cnyls51N8syKxujfXlnQWswYQjMmiLAeW.png',
                'status' => 'active',
                'created_at' => '2025-04-23 02:21:57',
                'updated_at' => '2025-04-23 02:25:16',
            ],
            [
                'type' => 'partner',
                'name' => 'ARTAJASA',
                'logo' => 'partners/logos/r06p6yYLR2YXGI3ONTyzysaS1KBNN7FKczDsEcMD.png',
                'status' => 'active',
                'created_at' => '2025-04-23 02:21:57',
                'updated_at' => '2025-04-23 02:25:27',
            ],
            [
                'type' => 'partner',
                'name' => 'INTEGRATED LOGISTICS SERVICES',
                'logo' => 'partners/logos/cD8GS3P0MUrKnr1vT6xZBDDIziYqwSXZ8Z6SWbBp.png',
                'status' => 'active',
                'created_at' => '2025-04-23 02:21:57',
                'updated_at' => '2025-04-23 02:25:37',
            ],
            [
                'type' => 'partner',
                'name' => 'INTAN UTAMA LOGISTIK',
                'logo' => 'partners/logos/4uh36tiVq1X4O5c083O1rbZd5lVLQdMFwhbwAWi7.png',
                'status' => 'active',
                'created_at' => '2025-04-23 02:21:57',
                'updated_at' => '2025-04-23 02:25:48',
            ],
            [
                'type' => 'partner',
                'name' => 'EXPRESS CARGO',
                'logo' => 'partners/logos/OynioJlMy8QqU7CxmwQes2YAriDIY8eWuLFwHEOd.png',
                'status' => 'active',
                'created_at' => '2025-04-23 02:21:57',
                'updated_at' => '2025-04-23 02:25:56',
            ],
            [
                'type' => 'partner',
                'name' => 'PT BAHAGIA JAYA SEJAHTERA',
                'logo' => 'partners/logos/izYd7PjV3q77Tlc5RXg26QVEncDLFPo2xJHZV92A.png',
                'status' => 'active',
                'created_at' => '2025-04-23 02:21:57',
                'updated_at' => '2025-04-23 02:26:04',
            ],
        ];

        foreach ($partners as $partner) {
            Partner::create($partner);
        }
    }
} 