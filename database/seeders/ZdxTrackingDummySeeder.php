<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ZdxTrackingDummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data lama jika ada
        DB::table('tracking_dummy')->truncate();
        
        // Buat 10 contoh data tracking dummy
        $dummyData = [];
        
        for ($i = 1; $i <= 10; $i++) {
            $trackingNo = 'CGK' . str_pad($i, 6, '0', STR_PAD_LEFT) . 'EGT';
            $createdDate = now()->subDays(rand(1, 10))->format('Y-m-d H:i:s');
            
            $dummyData[] = [
                'awb_no' => $trackingNo,
                'reff_no' => 'R' . rand(10000, 99999),
                'shipper_name' => 'PENGIRIM ' . $i,
                'receiver_name' => 'PENERIMA ' . $i,
                'receiver_address' => 'Alamat Penerima ' . $i . ', Kota ' . $this->getRandomCity(),
                'receiver_phone' => '08' . rand(100000000, 999999999),
                'origin_district_code' => 'JK00',
                'destination_district_code' => 'JI280' . rand(1, 9),
                'tlc_origin' => 'CGK',
                'tlc_destination' => $this->getRandomTlc(),
                'special_instruction' => $this->getRandomInstruction(),
                'total_colly' => rand(1, 5),
                'total_weight_charge' => rand(1, 20),
                'volumetric' => rand(10, 50) . 'x' . rand(10, 50) . 'x' . rand(10, 50),
                'service_type_code' => 'UDRREG',
                'status' => $this->getRandomStatus(),
                'rowstate' => $this->getRandomRowstate(),
                'rowstate_name' => 'SUCCESS DELIVERY',
                'transaction_type_code' => 'TRTCR',
                'created_at' => $createdDate,
                'timeline' => json_encode($this->generateTimeline($trackingNo, $createdDate))
            ];
        }
        
        // Masukkan data ke tabel
        foreach ($dummyData as $data) {
            DB::table('tracking_dummy')->insert($data);
        }
    }
    
    /**
     * Dapatkan status acak
     */
    private function getRandomStatus()
    {
        $statuses = [
            'DATA ENTRY',
            'OUTGOING',
            'TRANSFER LOCATION',
            'ARRIVAL FACILITIES',
            'WITH COURIER',
            'SUCCESS DELIVERY'
        ];
        
        return $statuses[array_rand($statuses)];
    }
    
    /**
     * Dapatkan rowstate acak
     */
    private function getRandomRowstate()
    {
        $rowstates = ['TRPD', 'TRSD', 'TRPR', 'TRPK'];
        return $rowstates[array_rand($rowstates)];
    }
    
    /**
     * Dapatkan TLC acak
     */
    private function getRandomTlc()
    {
        $tlcs = ['SUB', 'BDO', 'MES', 'JOG', 'SMG', 'UPG', 'DPS', 'PLM', 'PNK', 'BPN'];
        return $tlcs[array_rand($tlcs)];
    }
    
    /**
     * Dapatkan kota acak
     */
    private function getRandomCity()
    {
        $cities = ['Jakarta', 'Surabaya', 'Bandung', 'Medan', 'Yogyakarta', 'Semarang', 'Makassar', 'Denpasar', 'Palembang', 'Pontianak', 'Balikpapan'];
        return $cities[array_rand($cities)];
    }
    
    /**
     * Dapatkan instruksi acak
     */
    private function getRandomInstruction()
    {
        $instructions = [
            'JANGAN DIBANTING',
            'HUBUNGI PENERIMA DAHULU',
            'BARANG FRAGILE HATI-HATI',
            'KIRIM SIANG HARI',
            'PASTIKAN DITERIMA LANGSUNG',
            ''
        ];
        
        return $instructions[array_rand($instructions)];
    }
    
    /**
     * Generate timeline untuk tracking
     */
    private function generateTimeline($trackingNo, $createdDate)
    {
        $timeline = [];
        $startDate = \Carbon\Carbon::parse($createdDate);
        
        // Status 1: Data Entry
        $timeline[] = [
            'tracking_id' => null,
            'tracking_resi_no' => null,
            'awb_no' => $trackingNo,
            'created_at' => $startDate->format('Y-m-d H:i:s'),
            'description' => 'Paket Telah diverifikasi',
            'origin_district_code' => 'JK00',
            'tlc_origin' => 'CGK',
            'tlc_destination' => 'SUB',
            'status' => 'DATA ENTRY',
            'customer_name' => null,
            'city_name' => 'JAKARTA',
            'total_weight' => null,
            'total_colly' => 1,
            'receiver_pod' => '',
            'receiver_relationship' => '',
            'status_pod' => ''
        ];
        
        // Status 2: Outgoing
        $timeline[] = [
            'tracking_id' => null,
            'tracking_resi_no' => null,
            'awb_no' => $trackingNo,
            'created_at' => $startDate->addHours(2)->format('Y-m-d H:i:s'),
            'description' => 'Paket Keluar dari Kantor Cabang Asal',
            'origin_district_code' => 'JK00',
            'tlc_origin' => 'CGK',
            'tlc_destination' => 'SUB',
            'status' => 'OUTGOING',
            'customer_name' => null,
            'city_name' => 'JAKARTA',
            'total_weight' => null,
            'total_colly' => 1,
            'receiver_pod' => '',
            'receiver_relationship' => '',
            'status_pod' => ''
        ];
        
        // Status 3: Transfer Location
        $timeline[] = [
            'tracking_id' => null,
            'tracking_resi_no' => null,
            'awb_no' => $trackingNo,
            'created_at' => $startDate->addHours(3)->format('Y-m-d H:i:s'),
            'description' => 'Paket Menuju ke Kantor Cabang Tujuan',
            'origin_district_code' => 'JK00',
            'tlc_origin' => 'CGK',
            'tlc_destination' => 'SUB',
            'status' => 'TRANSFER LOCATION',
            'customer_name' => null,
            'city_name' => 'JAKARTA',
            'total_weight' => null,
            'total_colly' => 1,
            'receiver_pod' => '',
            'receiver_relationship' => '',
            'status_pod' => ''
        ];
        
        // Status 4: Arrival
        $timeline[] = [
            'tracking_id' => null,
            'tracking_resi_no' => null,
            'awb_no' => $trackingNo,
            'created_at' => $startDate->addHours(12)->format('Y-m-d H:i:s'),
            'description' => 'Paket sudah tiba di Kantor Cabang Tujuan',
            'origin_district_code' => 'JK00',
            'tlc_origin' => 'CGK',
            'tlc_destination' => 'SUB',
            'status' => 'ARRIVAL FACILITIES',
            'customer_name' => null,
            'city_name' => 'JAKARTA',
            'total_weight' => null,
            'total_colly' => 1,
            'receiver_pod' => '',
            'receiver_relationship' => '',
            'status_pod' => ''
        ];
        
        // Status 5: With Courier
        $timeline[] = [
            'tracking_id' => null,
            'tracking_resi_no' => null,
            'awb_no' => $trackingNo,
            'created_at' => $startDate->addHours(4)->format('Y-m-d H:i:s'),
            'description' => 'Penjadwalan Pengiriman ke tujuan oleh KURIR',
            'origin_district_code' => 'JK00',
            'tlc_origin' => 'CGK',
            'tlc_destination' => 'SUB',
            'status' => 'WITH COURIER',
            'customer_name' => null,
            'city_name' => 'JAKARTA',
            'total_weight' => null,
            'total_colly' => 1,
            'receiver_pod' => '',
            'receiver_relationship' => '',
            'status_pod' => ''
        ];
        
        // Status 6: Delivery Success
        $timeline[] = [
            'tracking_id' => null,
            'tracking_resi_no' => null,
            'awb_no' => $trackingNo,
            'created_at' => $startDate->addHours(5)->format('Y-m-d H:i:s'),
            'description' => 'Pengiriman sukses diterima, Penerima : PENERIMA, Hubungan Penerima : PENERIMA LANGSUNG',
            'origin_district_code' => 'JK00',
            'tlc_origin' => 'CGK',
            'tlc_destination' => 'SUB',
            'status' => 'SUCCESS DELIVERY',
            'customer_name' => null,
            'city_name' => 'JAKARTA',
            'total_weight' => null,
            'total_colly' => 1,
            'receiver_pod' => '',
            'receiver_relationship' => '',
            'status_pod' => ''
        ];
        
        return $timeline;
    }
} 