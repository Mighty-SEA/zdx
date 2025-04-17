<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class AnalyticsSettingsController extends Controller
{
    /**
     * Tampilkan halaman pengaturan Google Analytics
     */
    public function index()
    {
        // Tampilkan notifikasi pengalihan
        $redirectMessage = 'Pengaturan Google Analytics telah dipindahkan ke halaman Pengaturan. Anda akan dialihkan dalam beberapa detik.';
        
        $propertyId = Setting::getValue('google_analytics_property_id', '');
        $hasCredentials = Storage::exists('app/analytics/service-account-credentials.json');
        
        return view('admin.analytics-settings', compact('propertyId', 'hasCredentials', 'redirectMessage'));
    }
    
    /**
     * Simpan pengaturan Google Analytics
     */
    public function store(Request $request)
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
        
        // Redirect ke halaman pengaturan yang baru dengan tab analytics
        return redirect()->route('admin.settings', ['#analytics'])
            ->with('success', 'Pengaturan Google Analytics berhasil disimpan.');
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
