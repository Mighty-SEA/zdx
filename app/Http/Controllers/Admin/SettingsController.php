<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

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
        
        // Data untuk tab API
        $apiKey = Setting::getValue('api_key', '');
        $apiEnabled = Setting::getValue('api_enabled', false);
        $webhookUrl = Setting::getValue('webhook_url', '');
        
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
            'apiKey',
            'apiEnabled',
            'webhookUrl'
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
} 