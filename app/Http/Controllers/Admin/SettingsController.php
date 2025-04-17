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
        ]);
        
        // Simpan semua pengaturan perusahaan
        Setting::setValue('company_name', $request->company_name, 'company');
        Setting::setValue('company_address', $request->company_address, 'company');
        Setting::setValue('company_phone', $request->company_phone, 'company');
        Setting::setValue('company_email', $request->company_email, 'company');
        Setting::setValue('company_tax_id', $request->company_tax_id, 'company');
        Setting::setValue('company_description', $request->company_description, 'company');
        
        return redirect()->route('admin.settings')
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