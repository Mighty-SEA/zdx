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
                'type' => 'partner',
                'name' => 'RANO CIPTA NUSALOG',
            ],
            [
                'type' => 'partner',
                'name' => 'PT PANDARAN',
            ],
            [
                'type' => 'partner',
                'name' => 'ONGKIR EXPRESS',
            ],
            [
                'type' => 'partner',
                'name' => 'S-LOG',
            ],
            [
                'type' => 'partner',
                'name' => 'BERLY CARGO',
            ],
            [
                'type' => 'partner',
                'name' => 'PT BAHAGIA RIZKI SELARAS',
            ],
            [
                'type' => 'partner',
                'name' => 'EXPRESS & LOGISTICS',
            ],
            [
                'type' => 'partner',
                'name' => 'ARTAJASA',
            ],
            [
                'type' => 'partner',
                'name' => 'INTEGRATED LOGISTICS SERVICES',
            ],
            [
                'type' => 'partner',
                'name' => 'INTAN UTAMA LOGISTIK',
            ],
            [
                'type' => 'partner',
                'name' => 'EXPRESS CARGO',
            ],
            [
                'type' => 'partner',
                'name' => 'PT BAHAGIA JAYA SEJAHTERA',
            ],
        ];

        foreach ($partners as $partner) {
            Partner::create($partner);
        }
    }
} 