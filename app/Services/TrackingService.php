<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class TrackingService
{
    protected $client;
    protected $settings;
    
    /**
     * Inisialisasi service dengan mengambil pengaturan tracking
     */
    public function __construct()
    {
        $this->client = new Client([
            'timeout' => 15,
            'http_errors' => false,
            'verify' => false, // Menonaktifkan verifikasi SSL untuk lingkungan development
        ]);
        
        $this->loadSettings();
    }
    
    /**
     * Muat pengaturan tracking dari cache atau database
     */
    protected function loadSettings()
    {
        $this->settings = Cache::remember('tracking_settings', 1800, function () {
            return [
                'use_external_tracking' => (bool) Setting::getValue('use_external_tracking', false),
                'provider' => Setting::getValue('tracking_provider', 'zdx_internal'),
                'api_url' => Setting::getValue('tracking_api_url', ''),
                'api_key' => Setting::getValue('tracking_api_key', ''),
                'api_secret' => Setting::getValue('tracking_api_secret', ''),
                'request_method' => Setting::getValue('tracking_request_method', 'GET'),
                'request_headers' => $this->parseJson(Setting::getValue('tracking_request_headers', '{}'), []),
                'response_mapping' => $this->parseJson(Setting::getValue('tracking_response_mapping', '{}'), []),
            ];
        });
    }
    
    /**
     * Parse JSON string ke array, dengan fallback jika format tidak valid
     */
    protected function parseJson($jsonString, $default)
    {
        if (empty($jsonString)) {
            return $default;
        }
        
        try {
            return json_decode($jsonString, true, 512, JSON_THROW_ON_ERROR);
        } catch (\Exception $e) {
            Log::error('Error parsing JSON in TrackingService: ' . $e->getMessage());
            return $default;
        }
    }
    
    /**
     * Lacak pengiriman berdasarkan nomor resi
     */
    public function trackShipment($trackingNumber)
    {
        // Jika tracking eksternal dinonaktifkan, gunakan internal tracking
        if (!$this->settings['use_external_tracking']) {
            return $this->getInternalTrackingData($trackingNumber);
        }
        
        // Gunakan provider tertentu
        switch ($this->settings['provider']) {
            case 'wahana':
                return $this->trackWahana($trackingNumber);
            case 'jne':
                return $this->trackJNE($trackingNumber);
            case 'sicepat':
                return $this->trackSiCepat($trackingNumber);
            case 'pos_indonesia':
                return $this->trackPosIndonesia($trackingNumber);
            case 'custom':
                return $this->trackWithCustomAPI($trackingNumber);
            default:
                return $this->getInternalTrackingData($trackingNumber);
        }
    }
    
    /**
     * Mendapatkan data tracking internal
     */
    protected function getInternalTrackingData($trackingNumber)
    {
        // Ini sebaiknya diganti dengan logika yang sebenarnya dari database
        // Contoh data saja untuk tujuan demonstrasi
        return [
            'tracking_number' => $trackingNumber,
            'status' => 'on_delivery',
            'status_text' => 'Dalam Pengiriman',
            'date_sent' => date('Y-m-d', strtotime('-1 day')),
            'date_estimated' => date('Y-m-d', strtotime('+1 day')),
            'service' => 'ZDX Express',
            'shipper' => [
                'name' => 'PT. Sinar Jaya',
                'address' => 'Jakarta Barat, DKI Jakarta',
            ],
            'receiver' => [
                'name' => 'PT. Maju Bersama',
                'address' => 'Bandung, Jawa Barat',
            ],
            'timeline' => [
                [
                    'status' => 'on_delivery',
                    'status_text' => 'Dalam Pengiriman',
                    'description' => 'Paket telah dikirim dan sedang dalam perjalanan',
                    'timestamp' => date('Y-m-d H:i:s', strtotime('-6 hours')),
                    'location' => 'Jakarta',
                ],
                [
                    'status' => 'processed',
                    'status_text' => 'Paket Diproses',
                    'description' => 'Paket sedang diproses di gudang Jakarta',
                    'timestamp' => date('Y-m-d H:i:s', strtotime('-12 hours')),
                    'location' => 'Jakarta',
                ],
                [
                    'status' => 'received',
                    'status_text' => 'Paket Diterima',
                    'description' => 'Paket telah diterima di gudang Jakarta',
                    'timestamp' => date('Y-m-d H:i:s', strtotime('-20 hours')),
                    'location' => 'Jakarta',
                ],
                [
                    'status' => 'pickup',
                    'status_text' => 'Paket Dijemput',
                    'description' => 'Paket telah dijemput dari lokasi pengirim',
                    'timestamp' => date('Y-m-d H:i:s', strtotime('-1 day')),
                    'location' => 'Jakarta',
                ],
            ],
        ];
    }
    
    /**
     * Lacak pengiriman menggunakan API kustom
     */
    protected function trackWithCustomAPI($trackingNumber)
    {
        try {
            $url = str_replace('{tracking_number}', $trackingNumber, $this->settings['api_url']);
            
            // Siapkan headers
            $headers = [
                'Accept' => 'application/json',
            ];
            
            // Tambahkan API key ke headers jika ada
            if (!empty($this->settings['api_key'])) {
                $headers['Authorization'] = 'Bearer ' . $this->settings['api_key'];
            }
            
            // Tambahkan headers kustom jika ada
            if (!empty($this->settings['request_headers']) && is_array($this->settings['request_headers'])) {
                $headers = array_merge($headers, $this->settings['request_headers']);
            }
            
            // Buat request options
            $options = [
                'headers' => $headers,
            ];
            
            // Tambahkan body jika metode POST
            if ($this->settings['request_method'] === 'POST') {
                $options['json'] = ['tracking_number' => $trackingNumber];
            }
            
            // Kirim request
            $response = $this->client->request(
                $this->settings['request_method'],
                $url,
                $options
            );
            
            // Parse response
            $statusCode = $response->getStatusCode();
            $body = (string) $response->getBody();
            $jsonData = json_decode($body, true);
            
            // Jika sukses, lakukan mapping data
            if ($statusCode >= 200 && $statusCode < 300 && $jsonData) {
                return $this->mapResponseData($jsonData, $trackingNumber);
            }
            
            throw new \Exception("API response error: HTTP $statusCode");
        } catch (\Exception $e) {
            Log::error('Error in TrackingService (Custom API): ' . $e->getMessage());
            
            return [
                'error' => true,
                'message' => 'Gagal mengambil data tracking dari penyedia layanan.',
            ];
        }
    }
    
    /**
     * Mapping response data dari API eksternal ke format ZDX
     */
    protected function mapResponseData($data, $trackingNumber)
    {
        // Jika tidak ada mapping, gunakan data asli
        if (empty($this->settings['response_mapping'])) {
            return $data;
        }
        
        $result = [
            'tracking_number' => $trackingNumber ?? '',
            'status' => 'unknown',
            'status_text' => 'Tidak Diketahui',
            'shipper' => [],
            'receiver' => [],
            'timeline' => [],
        ];
        
        // Lakukan mapping berdasarkan aturan
        foreach ($this->settings['response_mapping'] as $targetKey => $sourcePath) {
            // Jika source path berupa string, gunakan dot notation untuk akses nested array
            if (is_string($sourcePath)) {
                $value = $this->getNestedValue($data, $sourcePath);
                if ($value !== null) {
                    // Handle kasus khusus untuk jenis data tertentu
                    if ($targetKey === 'shipper' || $targetKey === 'receiver' || $targetKey === 'timeline') {
                        $result[$targetKey] = $value;
                    } else {
                        $result[$targetKey] = $value;
                    }
                }
            }
        }
        
        // Standardisasi status
        $result['status_text'] = $this->getStatusText($result['status']);
        
        return $result;
    }
    
    /**
     * Mendapatkan nilai dari array bersarang menggunakan dot notation
     * Contoh: "data.response.tracking.status"
     */
    protected function getNestedValue($array, $path)
    {
        $keys = explode('.', $path);
        $value = $array;
        
        foreach ($keys as $key) {
            if (!isset($value[$key])) {
                return null;
            }
            $value = $value[$key];
        }
        
        return $value;
    }
    
    /**
     * Konversi kode status ke teks yang lebih mudah dibaca
     */
    protected function getStatusText($status)
    {
        $statusMap = [
            'pickup' => 'Paket Dijemput',
            'received' => 'Paket Diterima',
            'processed' => 'Paket Diproses',
            'on_delivery' => 'Dalam Pengiriman',
            'delivered' => 'Paket Terkirim',
            'returned' => 'Paket Dikembalikan',
            'failed' => 'Pengiriman Gagal',
            'pending' => 'Menunggu Proses',
        ];
        
        return $statusMap[$status] ?? 'Status Tidak Diketahui';
    }
    
    /**
     * Implementasi untuk tracking Wahana
     */
    protected function trackWahana($trackingNumber)
    {
        // Implementasi spesifik untuk Wahana
        // Untuk contoh, gunakan API kustom dengan mapping pre-konfigurasi
        $this->settings['api_url'] = 'https://api.wahana.com/v1/tracking/{tracking_number}';
        $this->settings['request_method'] = 'GET';
        $this->settings['request_headers'] = [
            'Accept' => 'application/json',
            'X-API-Key' => $this->settings['api_key']
        ];
        $this->settings['response_mapping'] = [
            'tracking_number' => 'data.waybill',
            'status' => 'data.status.code',
            'status_text' => 'data.status.description',
            'service' => 'data.service',
            'shipper' => 'data.shipper',
            'receiver' => 'data.receiver',
            'timeline' => 'data.history',
        ];
        
        return $this->trackWithCustomAPI($trackingNumber);
    }
    
    /**
     * Implementasi untuk tracking JNE
     */
    protected function trackJNE($trackingNumber)
    {
        // Implementasi spesifik untuk JNE
        // Sama seperti di atas, gunakan pre-konfigurasi
        $this->settings['api_url'] = 'https://api.jne.co.id/tracking/{tracking_number}';
        $this->settings['request_method'] = 'GET';
        $this->settings['request_headers'] = [
            'Accept' => 'application/json',
            'X-API-Key' => $this->settings['api_key']
        ];
        $this->settings['response_mapping'] = [
            'tracking_number' => 'cnote.cnote_no',
            'status' => 'cnote.pod_status',
            'service' => 'cnote.service',
            'shipper' => 'detail.shipper',
            'receiver' => 'detail.receiver',
            'timeline' => 'history',
        ];
        
        return $this->trackWithCustomAPI($trackingNumber);
    }
    
    /**
     * Implementasi untuk tracking SiCepat
     */
    protected function trackSiCepat($trackingNumber)
    {
        // Implementasi spesifik untuk SiCepat
        $this->settings['api_url'] = 'https://api.sicepat.com/customer/waybill/{tracking_number}';
        $this->settings['request_method'] = 'GET';
        $this->settings['request_headers'] = [
            'Accept' => 'application/json',
            'API-Key' => $this->settings['api_key']
        ];
        $this->settings['response_mapping'] = [
            'tracking_number' => 'waybill_number',
            'status' => 'last_status.status',
            'service' => 'service',
            'shipper' => 'sender',
            'receiver' => 'receiver',
            'timeline' => 'track_history',
        ];
        
        return $this->trackWithCustomAPI($trackingNumber);
    }
    
    /**
     * Implementasi untuk tracking Pos Indonesia
     */
    protected function trackPosIndonesia($trackingNumber)
    {
        // Implementasi spesifik untuk Pos Indonesia
        $this->settings['api_url'] = 'https://api.posindonesia.co.id/v1/track/{tracking_number}';
        $this->settings['request_method'] = 'GET';
        $this->settings['request_headers'] = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->settings['api_key']
        ];
        $this->settings['response_mapping'] = [
            'tracking_number' => 'response.data.barcode',
            'status' => 'response.data.status',
            'service' => 'response.data.productName',
            'shipper' => 'response.data.sender',
            'receiver' => 'response.data.receiver',
            'timeline' => 'response.data.history',
        ];
        
        return $this->trackWithCustomAPI($trackingNumber);
    }
}