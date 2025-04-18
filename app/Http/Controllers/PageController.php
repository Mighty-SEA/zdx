<?php

namespace App\Http\Controllers;

use App\Models\PageSeoSetting;
use App\Services\TrackingService;
use Illuminate\Http\Request;
use App\Models\HomeContent;

class PageController extends Controller
{
    /**
     * Controller untuk halaman frontend
     */
    
    /**
     * Mendapatkan data SEO dari database untuk halaman
     */
    protected function getSeoData($identifier = 'home')
    {
        // Get SEO settings from database
        $pageSeo = PageSeoSetting::where('page_identifier', $identifier)->first();
        
        // If not found or using global settings, get home page settings as default
        if (!$pageSeo || $pageSeo->uses_global_settings) {
            $defaultSeo = PageSeoSetting::where('page_identifier', 'home')->first();
            
            // If still not found, use hardcoded defaults
            if (!$defaultSeo) {
                return [
                    'title' => 'ZDX Express - Jasa Pengiriman Cepat & Terpercaya',
                    'description' => 'ZDX Express menyediakan layanan pengiriman cepat, aman, dan terpercaya ke seluruh Indonesia. Dapatkan tarif terbaik dan tracking real-time.',
                    'keywords' => 'jasa pengiriman, ekspedisi, kurir, pengiriman barang, tracking paket',
                    'og_title' => 'ZDX Express - Jasa Pengiriman Cepat & Terpercaya',
                    'og_description' => 'ZDX Express menyediakan layanan pengiriman cepat, aman, dan terpercaya ke seluruh Indonesia.',
                    'og_image' => asset('images/og-image.jpg'),
                    'meta_robots' => 'index, follow',
                    'canonical_url' => url($identifier == 'home' ? '/' : $identifier),
                    'custom_schema' => null
                ];
            }
            
            // Use home settings with page-specific canonical URL
            $seoData = [
                'title' => $defaultSeo->title,
                'description' => $defaultSeo->description,
                'keywords' => $defaultSeo->keywords,
                'og_title' => $defaultSeo->og_title ?? $defaultSeo->title,
                'og_description' => $defaultSeo->og_description ?? $defaultSeo->description,
                'og_image' => $defaultSeo->og_image ? asset($defaultSeo->og_image) : asset('images/og-image.jpg'),
                'meta_robots' => $defaultSeo->custom_robots ?? 'index, follow',
                'canonical_url' => url($identifier == 'home' ? '/' : $identifier),
                'custom_schema' => $defaultSeo->custom_schema
            ];
        } else {
            // Use page-specific settings
            $seoData = [
                'title' => $pageSeo->title,
                'description' => $pageSeo->description,
                'keywords' => $pageSeo->keywords,
                'og_title' => $pageSeo->og_title ?? $pageSeo->title,
                'og_description' => $pageSeo->og_description ?? $pageSeo->description,
                'og_image' => $pageSeo->og_image ? asset($pageSeo->og_image) : asset('images/og-image.jpg'),
                'meta_robots' => $pageSeo->custom_robots ?? 'index, follow',
                'canonical_url' => url($identifier == 'home' ? '/' : $identifier),
                'custom_schema' => $pageSeo->custom_schema
            ];
        }
        
        return $seoData;
    }
    
    /**
     * Halaman Beranda
     */
    public function home()
    {
        $seoData = $this->getSeoData('home');
        
        // Mengambil data konten home dari database
        $homeContent = [];
        $contentSections = HomeContent::where('is_active', true)
            ->orderBy('order', 'asc')
            ->get();
        
        // Mengatur konten berdasarkan section key
        foreach ($contentSections as $section) {
            $homeContent[$section->section_key] = $section;
        }
        
        // Mengambil semua layanan yang dipublikasikan dari database
        $services = \App\Models\Service::where('status', 'published')->get();
        
        // Mengambil partner aktif untuk ditampilkan di bagian "Dipercaya oleh"
        $partners = \App\Models\Partner::where('status', 'active')
            ->whereNotNull('logo_path')
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();
        
        return view('home', compact('seoData', 'services', 'partners', 'homeContent'));
    }
    
    /**
     * Halaman Layanan
     */
    public function services()
    {
        $seoData = $this->getSeoData('services');
        
        // Mengambil semua layanan yang dipublikasikan dari database
        $services = \App\Models\Service::where('status', 'published')->get();
        
        return view('services', compact('seoData', 'services'));
    }
    
    /**
     * Halaman Detail Layanan
     */
    public function serviceDetail($slug)
    {
        // Mencari layanan berdasarkan slug
        $service = \App\Models\Service::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();
            
        // Cek apakah ada pengaturan SEO khusus untuk layanan ini
        $serviceIdentifier = 'service-' . $slug;
        $seoData = $this->getSeoData($serviceIdentifier);
        
        // Jika layanan memiliki gambar, gunakan sebagai og:image
        if ($service->image) {
            $seoData['og_image'] = asset($service->image);
        }
        
        // Canonical URL selalu ke layanan
        $seoData['canonical_url'] = url('layanan/' . $service->slug);
        
        return view('service-detail', compact('service', 'seoData'));
    }
    
    /**
     * Halaman Tarif
     */
    public function rates()
    {
        $seoData = $this->getSeoData('rates');
        
        // Mengambil daftar pulau untuk filter
        $pulauList = \App\Models\Rate::select('pulau')->distinct()->pluck('pulau');
        
        // Mengambil daftar provinsi untuk dropdown
        $provinsiList = \App\Models\Rate::select('provinsi')->distinct()->orderBy('provinsi')->pluck('provinsi');
        
        // Mengambil daftar kota (dengan batas 20 kota populer) untuk dropdown
        $kotaPopuler = \App\Models\Rate::select('kota_kab')
            ->distinct()
            ->orderBy('kota_kab')
            ->limit(20)
            ->pluck('kota_kab');
        
        // Mengambil data tarif populer (10 kota terpopuler berdasarkan urutan abjad)
        $tarifPopuler = \App\Models\Rate::select('pulau', 'provinsi', 'kota_kab', 'harga_satuan', 'minimal_kg', 'estimasi')
            ->orderBy('provinsi')
            ->orderBy('kota_kab')
            ->limit(10)
            ->get();
        
        // Menyiapkan variable untuk tampilan
        $popularCities = $kotaPopuler;
        $islands = $pulauList;
        $provinces = $provinsiList;
        $popularRates = $tarifPopuler;
        
        return view('rates', compact('seoData', 'islands', 'provinces', 'popularCities', 'popularRates'));
    }
    
    /**
     * API untuk pencarian tarif
     */
    public function searchRates(Request $request)
    {
        $kotaTujuan = $request->input('destination');
        $berat = floatval($request->input('weight', 1));
        
        // Cari tarif berdasarkan kota tujuan
        $tarif = \App\Models\Rate::where('kota_kab', 'LIKE', "%{$kotaTujuan}%")
            ->orWhere('provinsi', 'LIKE', "%{$kotaTujuan}%")
            ->orWhere('kelurahan_kecamatan', 'LIKE', "%{$kotaTujuan}%")
            ->first();
            
        if (!$tarif) {
            return response()->json([
                'success' => false,
                'message' => 'Tarif untuk tujuan tersebut tidak ditemukan'
            ]);
        }
        
        // Hitung total biaya berdasarkan berat dan minimal_kg
        $beratDihitung = max($berat, $tarif->minimal_kg);
        $totalBiaya = $beratDihitung * $tarif->harga_satuan;
        
        return response()->json([
            'success' => true,
            'city' => $tarif->kota_kab . ', ' . $tarif->provinsi,
            'rate_formatted' => number_format($tarif->harga_satuan, 0, ',', '.'),
            'total_formatted' => number_format($totalBiaya, 0, ',', '.')
        ]);
    }
    
    /**
     * API untuk mendapatkan daftar kota berdasarkan provinsi
     */
    public function getCities(Request $request)
    {
        $province = $request->input('province');
        
        // Validasi input
        if (empty($province)) {
            return response()->json([
                'success' => false,
                'message' => 'Provinsi harus diisi'
            ]);
        }
        
        // Ambil daftar kota/kabupaten berdasarkan provinsi
        $cities = \App\Models\Rate::where('provinsi', $province)
            ->select('kota_kab')
            ->distinct()
            ->orderBy('kota_kab')
            ->pluck('kota_kab');
            
        return response()->json([
            'success' => true,
            'cities' => $cities
        ]);
    }
    
    /**
     * API untuk mendapatkan daftar kelurahan/kecamatan berdasarkan provinsi dan kota
     */
    public function getKelurahans(Request $request)
    {
        $province = $request->input('province');
        $city = $request->input('city');
        
        // Validasi input
        if (empty($province) || empty($city)) {
            return response()->json([
                'success' => false,
                'message' => 'Provinsi dan kota harus diisi'
            ]);
        }
        
        // Ambil daftar kelurahan/kecamatan berdasarkan provinsi dan kota
        $kelurahans = \App\Models\Rate::where('provinsi', $province)
            ->where('kota_kab', $city)
            ->whereNotNull('kelurahan_kecamatan')
            ->where('kelurahan_kecamatan', '<>', '')
            ->select('kelurahan_kecamatan')
            ->distinct()
            ->orderBy('kelurahan_kecamatan')
            ->pluck('kelurahan_kecamatan');
            
        return response()->json([
            'success' => true,
            'kelurahans' => $kelurahans
        ]);
    }
    
    /**
     * API untuk menghitung tarif berdasarkan provinsi, kota, dan kelurahan (jika ada)
     */
    public function calculateRates(Request $request)
    {
        $province = $request->input('province');
        $city = $request->input('city');
        $kelurahan = $request->input('kelurahan');
        $berat = floatval($request->input('weight', 1));
        
        // Validasi input
        if (empty($province) || empty($city)) {
            return response()->json([
                'success' => false,
                'message' => 'Provinsi dan kota harus diisi'
            ]);
        }
        
        // Buat query untuk mencari tarif
        $query = \App\Models\Rate::where('provinsi', $province)
            ->where('kota_kab', $city);
            
        // Tambahkan filter kelurahan jika ada
        if (!empty($kelurahan)) {
            $query->where('kelurahan_kecamatan', $kelurahan);
        }
        
        // Ambil data tarif
        $tarif = $query->first();
        
        // Jika tidak ada tarif yang sesuai, coba tanpa filter kelurahan
        if (!$tarif && !empty($kelurahan)) {
            $tarif = \App\Models\Rate::where('provinsi', $province)
                ->where('kota_kab', $city)
                ->first();
        }
        
        // Jika masih tidak ada, coba pencarian lebih luas
        if (!$tarif) {
            $tarif = \App\Models\Rate::where('provinsi', $province)
                ->first();
                
            if (!$tarif) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tarif untuk tujuan tersebut tidak ditemukan'
                ]);
            }
        }
        
        // Increment views counter
        $tarif->increment('views');
        
        // Hitung total biaya berdasarkan berat dan minimal_kg
        $beratDihitung = max($berat, $tarif->minimal_kg);
        $totalBiaya = $beratDihitung * $tarif->harga_satuan;
        
        return response()->json([
            'success' => true,
            'rate' => $tarif->harga_satuan,
            'rate_formatted' => number_format($tarif->harga_satuan, 0, ',', '.'),
            'total_formatted' => number_format($totalBiaya, 0, ',', '.')
        ]);
    }
    
    /**
     * Halaman Tracking
     */
    public function tracking(Request $request)
    {
        $seoData = $this->getSeoData('tracking');
        
        // Cek jika ada parameter tracking_number
        $trackingNumber = $request->tracking_number;
        $trackingData = null;
        
        if ($trackingNumber) {
            $trackingService = new TrackingService();
            $trackingData = $trackingService->trackShipment($trackingNumber);
        }
        
        return view('tracking', compact('seoData', 'trackingData', 'trackingNumber'));
    }
    
    /**
     * Track pengiriman via AJAX
     */
    public function trackShipment(Request $request)
    {
        $request->validate([
            'tracking_number' => 'required|string|min:5|max:50',
        ]);
        
        $trackingNumber = $request->tracking_number;
        $trackingService = new TrackingService();
        $trackingData = $trackingService->trackShipment($trackingNumber);
        
        return response()->json([
            'success' => true,
            'data' => $trackingData,
        ]);
    }
    
    /**
     * Halaman Pelanggan & Partner
     */
    public function customer()
    {
        $seoData = $this->getSeoData('customer');
        
        // Mengambil data partner yang aktif
        $partners = \App\Models\Partner::where('status', 'active')->orderBy('created_at', 'desc')->get();
        
        // Memisahkan data customer dan partner untuk tampilan
        $customers = $partners->where('type', 'customer');
        $businessPartners = $partners->where('type', 'partner');
        
        return view('customer', compact('seoData', 'customers', 'businessPartners', 'partners'));
    }
    
    /**
     * Halaman Profil
     */
    public function profile()
    {
        $seoData = $this->getSeoData('profile');
        return view('profile', compact('seoData'));
    }
    
    /**
     * Halaman Kontak
     */
    public function contact()
    {
        $seoData = $this->getSeoData('contact');
        return view('contact', compact('seoData'));
    }
    
    /**
     * Halaman Komoditas
     */
    public function commodity()
    {
        $seoData = $this->getSeoData('commodity');
        return view('commodity', compact('seoData'));
    }
} 