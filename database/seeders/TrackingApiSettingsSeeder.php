<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class TrackingApiSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data Pengaturan API Tracking ZDX
        $this->createSetting('use_external_tracking', true, 'tracking');
        $this->createSetting('tracking_provider', 'zdx_api', 'tracking');
        $this->createSetting('tracking_api_url', 'https://www.apiweb.zdx.co.id/api/web/trackingWebAwb', 'tracking');
        $this->createSetting('tracking_api_key', 'AP1W3b_ZDX_PR0D#_2024', 'tracking'); // API Key ZDX
        $this->createSetting('tracking_api_secret', '', 'tracking');
        $this->createSetting('tracking_request_method', 'POST', 'tracking');
        
        // Headers default untuk API ZDX
        $headers = json_encode([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ]);
        $this->createSetting('tracking_request_headers', $headers, 'tracking');
        
        // Mapping response dari API ZDX ke format aplikasi
        $responseMapping = json_encode([
            'tracking_number' => 'process.awbdetail.awb_no',
            'status' => 'process.lasthistory.status',
            'status_text' => 'process.lasthistory.status',
            'service' => 'process.awbdetail.service_name',
            'shipper' => [
                'name' => 'process.awbdetail.shipper_name',
                'address' => 'process.awbdetail.city_origin'
            ],
            'receiver' => [
                'name' => 'process.awbdetail.receiver_name',
                'address' => 'process.awbdetail.receiver_address'
            ],
            'timeline' => 'data'
        ]);
        $this->createSetting('tracking_response_mapping', $responseMapping, 'tracking');
    }
    
    /**
     * Buat atau update setting
     */
    private function createSetting($key, $value, $group)
    {
        Setting::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'group' => $group
            ]
        );
    }
} 