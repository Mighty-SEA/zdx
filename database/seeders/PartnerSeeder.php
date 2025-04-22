<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $partners = [
            [
                'type' => 'Pelanggan',
                'name' => 'RANO CIPTA NUSALOG',
            ],
            [
                'type' => 'Pelanggan',
                'name' => 'PT PANDARAN',
            ],
            [
                'type' => 'Pelanggan',
                'name' => 'ONGKIR EXPRESS',
            ],
            [
                'type' => 'Pelanggan',
                'name' => 'S-LOG',
            ],
            [
                'type' => 'Pelanggan',
                'name' => 'BERLY CARGO',
            ],
            [
                'type' => 'Pelanggan',
                'name' => 'PT BAHAGIA RIZKI SELARAS',
            ],
            [
                'type' => 'Pelanggan',
                'name' => 'EXPRESS & LOGISTICS',
            ],
            [
                'type' => 'Pelanggan',
                'name' => 'ARTAJASA',
            ],
            [
                'type' => 'Pelanggan',
                'name' => 'INTEGRATED LOGISTICS SERVICES',
            ],
            [
                'type' => 'Pelanggan',
                'name' => 'INTAN UTAMA LOGISTIK',
            ],
            [
                'type' => 'Pelanggan',
                'name' => 'EXPRESS CARGO',
            ],
            [
                'type' => 'Pelanggan',
                'name' => 'PT BAHAGIA JAYA SEJAHTERA',
            ],
        ];

        foreach ($partners as $partner) {
            Partner::create($partner);
        }
    }
} 