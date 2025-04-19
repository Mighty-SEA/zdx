<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\ProfileContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    /**
     * Tampilkan halaman pengaturan admin
     */
    public function index()
    {
        // Data untuk tab Analytics
        $propertyId = Setting::getValue('google_analytics_property_id', '');
        $hasCredentials = Storage::exists('app/analytics/service-account-credentials.json');
        
        // Data untuk tab Perusahaan
        $companyName = Setting::getValue('company_name', 'PT ZDX Cargo Indonesia');
        $companyAddress = Setting::getValue('company_address', 'Jl. Gatot Subroto No. 123, Jakarta Selatan 12930');
        $companyPhone = Setting::getValue('company_phone', '021-12345678');
        $companyEmail = Setting::getValue('company_email', 'info@zdxcargo.com');
        $companyTaxId = Setting::getValue('company_tax_id', '01.234.567.8-901.000');
        $companyDescription = Setting::getValue('company_description', 'ZDX Cargo adalah perusahaan jasa pengiriman terpercaya yang melayani kebutuhan logistik bisnis dan pribadi dengan jangkauan nasional dan internasional.');
        $companyLogo = Setting::getValue('company_logo', '');
        $companyWebsite = Setting::getValue('company_website', 'www.zdxcargo.co.id');
        $companySocials = [
            'facebook' => Setting::getValue('company_facebook', 'https://facebook.com/zdxcargo'),
            'instagram' => Setting::getValue('company_instagram', 'https://instagram.com/zdxcargo'),
            'twitter' => Setting::getValue('company_twitter', ''),
            'linkedin' => Setting::getValue('company_linkedin', ''),
            'youtube' => Setting::getValue('company_youtube', ''),
        ];
        $companyLocation = [
            'latitude' => Setting::getValue('company_latitude', '-6.2088'),
            'longitude' => Setting::getValue('company_longitude', '106.8456'),
        ];
        
        // Data dari ProfileContent untuk tab Profile Lengkap
        $aboutContents = ProfileContent::where('section', 'about')->get();
        $visionContents = ProfileContent::where('section', 'vision')->get();
        $missionContents = ProfileContent::where('section', 'mission')->get();
        
        // Data untuk tab API
        $apiKey = Setting::getValue('api_key', '');
        $apiEnabled = Setting::getValue('api_enabled', false);
        $webhookUrl = Setting::getValue('webhook_url', '');
        
        // Data untuk tab Tracking API
        $useExternalTracking = Setting::getValue('use_external_tracking', false);
        $trackingProvider = Setting::getValue('tracking_provider', 'zdx_internal');
        $trackingApiUrl = Setting::getValue('tracking_api_url', '');
        $trackingApiKey = Setting::getValue('tracking_api_key', '');
        $trackingApiSecret = Setting::getValue('tracking_api_secret', '');
        $trackingRequestMethod = Setting::getValue('tracking_request_method', 'GET');
        $trackingRequestHeaders = Setting::getValue('tracking_request_headers', '');
        $trackingResponseMapping = Setting::getValue('tracking_response_mapping', '');
        
        return view('admin.settings', compact(
            'propertyId', 
            'hasCredentials',
            'companyName',
            'companyAddress',
            'companyPhone',
            'companyEmail',
            'companyTaxId',
            'companyDescription',
            'companyLogo',
            'companyWebsite',
            'companySocials',
            'companyLocation',
            'aboutContents',
            'visionContents',
            'missionContents',
            'apiKey',
            'apiEnabled',
            'webhookUrl',
            'useExternalTracking',
            'trackingProvider',
            'trackingApiUrl',
            'trackingApiKey',
            'trackingApiSecret',
            'trackingRequestMethod',
            'trackingRequestHeaders',
            'trackingResponseMapping'
        ));
    }
    
    /**
     * Simpan pengaturan Google Analytics
     */
    public function storeAnalytics(Request $request)
    {
        $request->validate([
            'property_id' => 'required|string',
            'credentials_file' => 'nullable|file|mimes:json',
        ]);
        
        // Simpan property ID
        Setting::setValue('google_analytics_property_id', $request->property_id, 'analytics');
        
        // Upload file kredensial jika ada
        if ($request->hasFile('credentials_file')) {
            $file = $request->file('credentials_file');
            
            // Pastikan direktori ada
            $directory = storage_path('app/analytics');
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }
            
            // Simpan file
            $file->storeAs('analytics', 'service-account-credentials.json');
        }
        
        // Hapus cache terkait analytics
        $this->clearAnalyticsCache();
        
        return redirect()->route('admin.settings')
            ->with('success', 'Pengaturan Google Analytics berhasil disimpan.');
    }
    
    /**
     * Simpan pengaturan perusahaan
     */
    public function storeCompany(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:100',
            'company_address' => 'required|string|max:255',
            'company_phone' => 'required|string|max:20',
            'company_email' => 'required|email|max:100',
            'company_tax_id' => 'nullable|string|max:30',
            'company_description' => 'nullable|string|max:500',
            'company_website' => 'nullable|string|max:100',
            'company_facebook' => 'nullable|string|max:255',
            'company_instagram' => 'nullable|string|max:255',
            'company_twitter' => 'nullable|string|max:255',
            'company_linkedin' => 'nullable|string|max:255',
            'company_youtube' => 'nullable|string|max:255',
            'company_latitude' => 'nullable|string|max:20',
            'company_longitude' => 'nullable|string|max:20',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'about_title' => 'nullable|string|max:100',
            'about_content' => 'nullable|string',
            'vision_title' => 'nullable|string|max:100',
            'vision_content' => 'nullable|string',
            'mission_title' => 'nullable|string|max:100',
            'mission_content' => 'nullable|string',
            'org_structure_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        // Simpan semua pengaturan perusahaan
        Setting::setValue('company_name', $request->company_name, 'company');
        Setting::setValue('company_address', $request->company_address, 'company');
        Setting::setValue('company_phone', $request->company_phone, 'company');
        Setting::setValue('company_email', $request->company_email, 'company');
        Setting::setValue('company_tax_id', $request->company_tax_id, 'company');
        Setting::setValue('company_description', $request->company_description, 'company');
        Setting::setValue('company_website', $request->company_website, 'company');
        
        // Simpan social media
        Setting::setValue('company_facebook', $request->company_facebook, 'company');
        Setting::setValue('company_instagram', $request->company_instagram, 'company');
        Setting::setValue('company_twitter', $request->company_twitter, 'company');
        Setting::setValue('company_linkedin', $request->company_linkedin, 'company');
        Setting::setValue('company_youtube', $request->company_youtube, 'company');
        
        // Simpan koordinat lokasi
        Setting::setValue('company_latitude', $request->company_latitude, 'company');
        Setting::setValue('company_longitude', $request->company_longitude, 'company');
        
        // Upload logo perusahaan jika ada
        if ($request->hasFile('company_logo')) {
            $image = $request->file('company_logo');
            $imageName = 'company_logo_' . time() . '.' . $image->getClientOriginalExtension();
            
            // Simpan gambar ke public/uploads/company
            $path = public_path('uploads/company');
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }
            
            // Hapus logo lama jika ada
            $oldLogo = Setting::getValue('company_logo', '');
            if ($oldLogo && file_exists(public_path($oldLogo))) {
                unlink(public_path($oldLogo));
            }
            
            $image->move($path, $imageName);
            Setting::setValue('company_logo', 'uploads/company/' . $imageName, 'company');
        }
        
        // Update konten profil jika ada perubahan
        if ($request->filled('about_title') || $request->filled('about_content')) {
            $aboutContent = ProfileContent::firstOrCreate(['section' => 'about'], [
                'title' => 'Tentang ZDX Cargo', 
                'content' => '',
                'is_active' => true,
                'order' => 1
            ]);
            
            $aboutData = [
                'title' => $request->about_title,
                'content' => $request->about_content,
            ];
            
            // Upload gambar struktur organisasi jika ada
            if ($request->hasFile('org_structure_image')) {
                $image = $request->file('org_structure_image');
                $imageName = 'struktur_' . time() . '.' . $image->getClientOriginalExtension();
                
                // Simpan gambar ke public/uploads/struktur
                $path = public_path('uploads/struktur');
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
                
                // Hapus gambar lama jika ada
                if ($aboutContent->org_structure_path && file_exists(public_path($aboutContent->org_structure_path))) {
                    unlink(public_path($aboutContent->org_structure_path));
                }
                
                $image->move($path, $imageName);
                $aboutData['org_structure_path'] = 'uploads/struktur/' . $imageName;
            }
            
            $aboutContent->update($aboutData);
        }
        
        // Update visi perusahaan
        if ($request->filled('vision_title') || $request->filled('vision_content')) {
            $visionContent = ProfileContent::firstOrCreate(['section' => 'vision'], [
                'title' => 'Visi Perusahaan', 
                'content' => '',
                'is_active' => true,
                'order' => 2
            ]);
            
            $visionContent->update([
                'title' => $request->vision_title,
                'content' => $request->vision_content,
            ]);
        }
        
        // Update misi perusahaan
        if ($request->filled('mission_title') || $request->filled('mission_content')) {
            $missionContent = ProfileContent::firstOrCreate(['section' => 'mission'], [
                'title' => 'Misi Perusahaan', 
                'content' => '',
                'is_active' => true,
                'order' => 3
            ]);
            
            $missionContent->update([
                'title' => $request->mission_title,
                'content' => $request->mission_content,
            ]);
        }
        
        // Hapus cache
        Cache::flush();
        
        return redirect()->route('admin.settings', ['#company'])
            ->with('success', 'Informasi perusahaan berhasil disimpan.');
    }
    
    /**
     * Simpan pengaturan API
     */
    public function storeApi(Request $request)
    {
        $request->validate([
            'api_enabled' => 'nullable',
            'webhook_url' => 'nullable|url|max:255',
        ]);
        
        // Generate API key baru jika diminta
        if ($request->has('generate_api_key')) {
            $apiKey = bin2hex(random_bytes(16)); // 32 karakter hexadecimal
            Setting::setValue('api_key', $apiKey, 'api');
        }
        
        // Simpan status API dan webhook URL
        Setting::setValue('api_enabled', $request->has('api_enabled'), 'api');
        Setting::setValue('webhook_url', $request->webhook_url, 'api');
        
        return redirect()->route('admin.settings')
            ->with('success', 'Pengaturan API berhasil disimpan.');
    }
    
    /**
     * Hapus semua cache terkait analytics
     */
    private function clearAnalyticsCache()
    {
        Cache::forget('analytics_data');
        Cache::forget('analytics_visitors');
        Cache::forget('analytics_top_pages');
        Cache::forget('analytics_referrers');
    }
    
    /**
     * Simpan pengaturan API Tracking
     */
    public function storeTracking(Request $request)
    {
        Log::info('Handling storeTracking request', [
            'request_data' => $request->all(),
            'has_external_tracking' => $request->has('use_external_tracking'),
            'tracking_api_url' => $request->tracking_api_url,
        ]);
        
        try {
            // Validasi dasar
            $validationRules = [
                'tracking_provider' => 'nullable|string',
                'tracking_api_key' => 'nullable|string',
                'tracking_api_secret' => 'nullable|string',
                'tracking_request_method' => 'nullable|in:GET,POST',
                'tracking_request_headers' => 'nullable|string',
                'tracking_response_mapping' => 'nullable|string',
            ];
            
            // Hapus validasi URL untuk custom provider atau URL yang berisi placeholder
            if (!empty($request->tracking_api_url)) {
                if ($request->tracking_provider == 'custom' || strpos($request->tracking_api_url, '{tracking_number}') !== false) {
                    // Tidak perlu validasi URL jika custom provider atau berisi placeholder
                    Log::info('Skipping URL validation for custom endpoint: ' . $request->tracking_api_url);
                } else {
                    // Validasi URL jika bukan custom provider
                    $validationRules['tracking_api_url'] = 'url';
                }
            }
            
            try {
                $validator = Validator::make($request->all(), $validationRules);
                if ($validator->fails()) {
                    Log::error('Validation error details', [
                        'errors' => $validator->errors()->toArray(),
                        'tracking_api_url' => $request->tracking_api_url
                    ]);
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput()
                        ->with('validation_error', $validator->errors()->first());
                }
            } catch (\Exception $e) {
                Log::error('Exception during validation', ['error' => $e->getMessage()]);
                throw $e;
            }
            
            Log::info('Validation passed');
            
            // Simpan pengaturan dasar
            Setting::setValue('use_external_tracking', $request->has('use_external_tracking'), 'tracking');
            Setting::setValue('tracking_provider', $request->tracking_provider, 'tracking');
            Setting::setValue('tracking_api_url', $request->tracking_api_url, 'tracking');
            Setting::setValue('tracking_api_key', $request->tracking_api_key, 'tracking');
            Setting::setValue('tracking_api_secret', $request->tracking_api_secret, 'tracking');
            Setting::setValue('tracking_request_method', $request->tracking_request_method ?: 'GET', 'tracking');
            
            Log::info('Basic settings saved');
            
            // Simpan headers dan response mapping sebagai JSON jika valid
            if ($request->tracking_request_headers) {
                try {
                    // Validasi format JSON sebelum menyimpan
                    json_decode($request->tracking_request_headers, true, 512, JSON_THROW_ON_ERROR);
                    Setting::setValue('tracking_request_headers', $request->tracking_request_headers, 'tracking');
                    Log::info('Request headers saved');
                } catch (\Exception $e) {
                    Log::error('Invalid JSON for request headers', ['error' => $e->getMessage()]);
                    return redirect()->back()->withErrors(['tracking_request_headers' => 'Format JSON tidak valid']);
                }
            } else {
                Setting::setValue('tracking_request_headers', null, 'tracking');
                Log::info('Request headers set to null');
            }
            
            if ($request->tracking_response_mapping) {
                try {
                    // Validasi format JSON sebelum menyimpan
                    json_decode($request->tracking_response_mapping, true, 512, JSON_THROW_ON_ERROR);
                    Setting::setValue('tracking_response_mapping', $request->tracking_response_mapping, 'tracking');
                    Log::info('Response mapping saved');
                } catch (\Exception $e) {
                    Log::error('Invalid JSON for response mapping', ['error' => $e->getMessage()]);
                    return redirect()->back()->withErrors(['tracking_response_mapping' => 'Format JSON tidak valid']);
                }
            } else {
                Setting::setValue('tracking_response_mapping', null, 'tracking');
                Log::info('Response mapping set to null');
            }
            
            // Hapus cache terkait tracking
            Cache::forget('tracking_settings');
            Log::info('Cache cleared');
            
            return redirect()->route('admin.settings', ['#tracking'])
                ->with('success', 'Pengaturan API Tracking berhasil disimpan.');
                
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error', ['errors' => $e->errors()]);
            throw $e;
        } catch (\Exception $e) {
            Log::error('Unexpected error in storeTracking', ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors(['general' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
    
    /**
     * Test API Tracking
     */
    public function testTracking(Request $request)
    {
        // Validasi request
        $request->validate([
            'tracking_number' => 'required|string',
            'api_url' => 'required|string',
            'api_key' => 'nullable|string',
            'provider' => 'required|string',
            'method' => 'required|in:GET,POST',
            'headers' => 'nullable|array',
        ]);
        
        try {
            Log::info('Testing tracking API', [
                'tracking_number' => $request->tracking_number,
                'api_url' => $request->api_url,
                'provider' => $request->provider,
                'method' => $request->method,
            ]);
            
            // Siapkan URL dengan nomor resi
            $url = str_replace('{tracking_number}', $request->tracking_number, $request->api_url);
            
            // Periksa apakah URL berisi tanda tanya - jika tidak dan method GET, tambahkan parameter
            if ($request->method === 'GET' && strpos($url, '?') === false && strpos($url, 'tracking_number') === false && strpos($url, 'awb') === false) {
                $url .= '?tracking_number=' . $request->tracking_number;
            }
            
            Log::info('Processed URL: ' . $url);
            
            // Siapkan headers
            $headers = [
                'Accept' => 'application/json',
            ];
            
            // Tambahkan API key ke headers jika ada
            if ($request->api_key) {
                $headers['Authorization'] = 'Bearer ' . $request->api_key;
            }
            
            // Tambahkan headers kustom jika ada
            if (isset($request->headers) && is_array($request->headers)) {
                $headers = array_merge($headers, $request->headers);
            }
            
            // Buat request
            $client = new \GuzzleHttp\Client([
                'verify' => false // Menonaktifkan verifikasi SSL untuk lingkungan development
            ]);
            
            $options = [
                'headers' => $headers,
                'http_errors' => false,
            ];
            
            // Tambahkan parameter tracking_number ke URL jika metode GET dan URL tidak memiliki placeholder
            if ($request->method === 'GET' && strpos($request->api_url, '{tracking_number}') === false) {
                if (strpos($url, 'api_key') === false && !empty($request->api_key)) {
                    // Tambahkan API key sebagai parameter URL untuk provider tertentu
                    $url .= (strpos($url, '?') !== false ? '&' : '?') . 'api_key=' . $request->api_key;
                }
                
                // Tambahkan parameter berdasarkan provider
                if ($request->provider === 'binderbyte' || strpos($url, 'binderbyte.com') !== false) {
                    $url .= (strpos($url, '?') !== false ? '&' : '?') . 'courier=jnt&awb=' . $request->tracking_number;
                } else {
                    $url .= (strpos($url, '?') !== false ? '&' : '?') . 'tracking_number=' . $request->tracking_number;
                }
            }
            
            // Tambahkan body jika metode POST
            if ($request->method === 'POST') {
                $options['json'] = ['tracking_number' => $request->tracking_number];
            }
            
            Log::info('Sending request to: ' . $url, [
                'method' => $request->method,
                'headers' => $headers,
                'options' => $options
            ]);
            
            // Kirim request ke API
            $response = $client->request($request->method, $url, $options);
            
            // Parsing response
            $statusCode = $response->getStatusCode();
            $body = (string) $response->getBody();
            $jsonResponse = null;
            
            try {
                $jsonResponse = json_decode($body, true, 512, JSON_THROW_ON_ERROR);
            } catch (\Exception $e) {
                Log::error('Failed to parse JSON response', [
                    'error' => $e->getMessage(),
                    'body' => $body
                ]);
                
                return response()->json([
                    'success' => false,
                    'message' => 'Response tidak valid atau tidak dalam format JSON: ' . $e->getMessage(),
                    'status_code' => $statusCode,
                    'response' => $body,
                    'request_url' => $url,
                    'request_method' => $request->method
                ]);
            }
            
            // Cek apakah response valid
            if ($statusCode >= 200 && $statusCode < 300 && $jsonResponse) {
                return response()->json([
                    'success' => true,
                    'response' => $jsonResponse,
                    'request_url' => $url,
                    'request_method' => $request->method
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Response tidak valid atau tidak dalam format JSON (Status Code: ' . $statusCode . ')',
                    'status_code' => $statusCode,
                    'response' => $body,
                    'request_url' => $url,
                    'request_method' => $request->method
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Exception in testTracking', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }
} 