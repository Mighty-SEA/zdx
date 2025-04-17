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
        $propertyId = Setting::getValue('google_analytics_property_id', '');
        $hasCredentials = Storage::exists('app/analytics/service-account-credentials.json');
        
        return view('admin.analytics-settings', compact('propertyId', 'hasCredentials'));
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
        
        return redirect()->route('admin.analytics-settings.index')
            ->with('success', 'Pengaturan Google Analytics berhasil disimpan.');
    }
    
    /**
     * Hapus semua cache terkait analytics
     */
    private function clearAnalyticsCache()
    {
        // Hapus cache pageviews
        foreach ([7, 30, 90] as $days) {
            Cache::forget('analytics_pageviews_' . $days);
            Cache::forget('analytics_pageviews_growth_' . $days);
            Cache::forget('analytics_bounce_rate_' . $days);
            Cache::forget('analytics_bounce_rate_change_' . $days);
            Cache::forget('analytics_avg_session_duration_' . $days);
            Cache::forget('analytics_avg_session_duration_change_' . $days);
            Cache::forget('analytics_top_pages_' . $days . '_5');
            Cache::forget('analytics_traffic_sources_' . $days);
            Cache::forget('analytics_chart_data_' . $days);
        }
    }
}
