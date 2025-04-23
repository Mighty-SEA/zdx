<?php

namespace App\Http\Controllers;

use App\Models\PageSeoSetting;
use App\Services\TrackingService;
use Illuminate\Http\Request;
use App\Models\HomeContent;
use App\Models\ProfileContent;
use App\Models\Blog;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

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
        
        // Mengambil semua layanan lain yang dipublikasikan untuk bagian "Layanan Terkait"
        $services = \App\Models\Service::where('status', 'published')->get();
        
        return view('service-detail', compact('service', 'seoData', 'services'));
    }
    
    /**
     * Halaman Tarif
     */
    public function rates()
    {
        $seoData = $this->getSeoData('rates');
        
        // Meningkatkan data SEO khusus untuk halaman tarif
        $seoData['title'] = $seoData['title'] ?? 'Tarif Pengiriman - PT. Zindan Diantar Express';
        $seoData['description'] = $seoData['description'] ?? 'Informasi tarif pengiriman barang ZDX Express yang kompetitif dan transparan untuk kebutuhan logistik Anda.';
        $seoData['keywords'] = $seoData['keywords'] ?? 'tarif pengiriman, harga cargo, biaya logistik, ongkos kirim, ekspedisi';
        $seoData['og_title'] = $seoData['og_title'] ?? 'Tarif Pengiriman - PT. Zindan Diantar Express';
        $seoData['og_description'] = $seoData['og_description'] ?? 'Informasi tarif pengiriman barang ZDX Express yang kompetitif dan transparan.';
        $seoData['twitter_title'] = $seoData['twitter_title'] ?? 'Tarif Pengiriman - PT. Zindan Diantar Express';
        $seoData['twitter_description'] = $seoData['twitter_description'] ?? 'Informasi tarif pengiriman barang ZDX Express yang kompetitif dan transparan.';
        $seoData['canonical_url'] = url('/tarif');
        
        // Tambahkan schema.org JSON-LD jika belum ada
        if (empty($seoData['custom_schema'])) {
            $seoData['custom_schema'] = '<script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "WebPage",
                "name": "Tarif Pengiriman - PT. Zindan Diantar Express",
                "description": "Informasi tarif pengiriman barang ZDX Express yang kompetitif dan transparan untuk kebutuhan logistik Anda.",
                "url": "'.url('/tarif').'",
                "mainEntity": {
                    "@type": "Service",
                    "name": "Layanan Cek Tarif ZDX Express",
                    "description": "Layanan untuk memeriksa dan menghitung biaya pengiriman barang ke berbagai tujuan di Indonesia",
                    "provider": {
                        "@type": "Organization",
                        "name": "PT. Zindan Diantar Express"
                    },
                    "offers": {
                        "@type": "AggregateOffer",
                        "priceCurrency": "IDR",
                        "availability": "https://schema.org/InStock"
                    }
                }
            }
            </script>';
        }
        
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
        
        // Meningkatkan data SEO khusus untuk halaman tracking
        $seoData['title'] = $seoData['title'] ?? 'Tracking Pengiriman - PT. Zindan Diantar Express';
        $seoData['description'] = $seoData['description'] ?? 'Lacak pengiriman barang Anda dengan mudah melalui layanan tracking ZDX Express. Pantau status pengiriman secara real-time.';
        $seoData['keywords'] = $seoData['keywords'] ?? 'lacak pengiriman, tracking zdx, cek resi, status kiriman, cargo tracking';
        $seoData['og_title'] = $seoData['og_title'] ?? 'Tracking Pengiriman - PT. Zindan Diantar Express';
        $seoData['og_description'] = $seoData['og_description'] ?? 'Lacak pengiriman barang Anda dengan mudah. Pantau status pengiriman secara real-time.';
        $seoData['twitter_title'] = $seoData['twitter_title'] ?? 'Tracking Pengiriman - PT. Zindan Diantar Express';
        $seoData['twitter_description'] = $seoData['twitter_description'] ?? 'Lacak pengiriman barang Anda dengan mudah. Pantau status pengiriman secara real-time.';
        $seoData['canonical_url'] = url('/tracking');
        
        // Tambahkan schema.org JSON-LD jika belum ada
        if (empty($seoData['custom_schema'])) {
            $seoData['custom_schema'] = '<script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "WebPage",
                "name": "Tracking Pengiriman - PT. Zindan Diantar Express",
                "description": "Lacak pengiriman barang Anda dengan mudah melalui layanan tracking ZDX Express. Pantau status pengiriman secara real-time.",
                "url": "'.url('/tracking').'",
                "mainEntity": {
                    "@type": "Service",
                    "name": "Layanan Tracking ZDX Express",
                    "description": "Layanan pelacakan pengiriman untuk memantau status pengiriman barang Anda secara real-time",
                    "provider": {
                        "@type": "Organization",
                        "name": "PT. Zindan Diantar Express"
                    }
                }
            }
            </script>';
        }
        
        // Cek jika ada parameter tracking_number
        $trackingNumber = $request->tracking_number;
        $trackingData = null;
        
        if ($trackingNumber) {
            $trackingService = new TrackingService();
            $trackingData = $trackingService->trackShipment($trackingNumber);
            
            // Jika tracking berhasil, tambahkan schema JSON-LD untuk hasil tracking
            if ($trackingData && !isset($trackingData['error'])) {
                $seoData['title'] = 'Hasil Tracking ' . $trackingNumber . ' - PT. Zindan Diantar Express';
                $seoData['description'] = 'Status pengiriman untuk nomor resi ' . $trackingNumber . '. ' . ($trackingData['status_text'] ?? 'Lacak status pengiriman secara real-time.');
                
                // Buat schema.org untuk data pengiriman jika ada data tracking
                $jsonLdData = [
                    '@context' => 'https://schema.org',
                    '@type' => 'ParcelDelivery',
                    'trackingNumber' => $trackingNumber,
                    'deliveryStatus' => $trackingData['status_text'] ?? 'Dalam Proses',
                    'carrier' => [
                        '@type' => 'Organization',
                        'name' => 'PT. Zindan Diantar Express'
                    ]
                ];
                
                // Tambahkan data lain jika tersedia
                if (isset($trackingData['date_sent'])) {
                    $jsonLdData['expectedArrivalFrom'] = $trackingData['date_sent'];
                }
                
                if (isset($trackingData['shipper']) && isset($trackingData['shipper']['name'])) {
                    $jsonLdData['sender'] = [
                        '@type' => 'Person',
                        'name' => $trackingData['shipper']['name']
                    ];
                }
                
                if (isset($trackingData['receiver']) && isset($trackingData['receiver']['name'])) {
                    $jsonLdData['recipient'] = [
                        '@type' => 'Person',
                        'name' => $trackingData['receiver']['name']
                    ];
                }
                
                $seoData['custom_schema'] = '<script type="application/ld+json">' . json_encode($jsonLdData) . '</script>';
            }
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
        
        // Meningkatkan data SEO khusus untuk halaman profil
        $seoData['title'] = $seoData['title'] ?? 'Profile - PT. Zindan Diantar Express';
        $seoData['description'] = $seoData['description'] ?? 'Profil PT. Zindan Diantar Express, perusahaan jasa pengiriman barang terpercaya di Indonesia. Informasi tentang visi, misi, layanan dan struktur perusahaan.';
        $seoData['keywords'] = $seoData['keywords'] ?? 'profil zdx, sejarah zdx, visi misi zdx, pengiriman barang, cargo indonesia';
        $seoData['og_title'] = $seoData['og_title'] ?? 'Profile - PT. Zindan Diantar Express';
        $seoData['og_description'] = $seoData['og_description'] ?? 'Profil PT. Zindan Diantar Express, perusahaan jasa pengiriman barang terpercaya di Indonesia.';
        $seoData['twitter_title'] = $seoData['twitter_title'] ?? 'Profile - PT. Zindan Diantar Express';
        $seoData['twitter_description'] = $seoData['twitter_description'] ?? 'Profil PT. Zindan Diantar Express, perusahaan jasa pengiriman barang terpercaya di Indonesia.';
        $seoData['canonical_url'] = url('/profile');
        
        // Tambahkan schema.org JSON-LD jika belum ada
        if (empty($seoData['custom_schema'])) {
            // Schema akan ditangani di view melalui conditional rendering
        }
        
        // Benar-benar hapus cache terlebih dahulu
        Cache::forget('profile_contents');
        
        // Ambil data langsung dari database tanpa cache
        $contents = ProfileContent::where('is_active', true)
            ->orderBy('order')
            ->get();
            
        // Lakukan grouping secara manual
        $groupedContents = [];
        foreach ($contents as $content) {
            $groupedContents[$content->section][] = $content;
        }
        
        // Ambil data layanan dari tabel services
        $services = \App\Models\Service::where('status', 'published')
            ->orderBy('id')
            ->limit(3)
            ->get();
        
        // Kirim data ke view
        return view('profile', [
            'contents' => $groupedContents,
            'services' => $services,
            'seoData' => $seoData
        ]);
    }
    
    /**
     * Halaman Kontak
     */
    public function contact()
    {
        $seoData = $this->getSeoData('contact');
        
        // Ambil data perusahaan dari database
        $companyInfo = new \stdClass();
        $companyInfo->company_name = \App\Models\Setting::getValue('company_name', 'PT ZDX Express Indonesia');
        $companyInfo->company_address = \App\Models\Setting::getValue('company_address', 'Jl. Gatot Subroto No. 123');
        $companyInfo->company_phone = \App\Models\Setting::getValue('company_phone', '021-12345678');
        $companyInfo->company_phone2 = \App\Models\Setting::getValue('company_phone2', '0858 1471 8889');
        $companyInfo->company_phone3 = \App\Models\Setting::getValue('company_phone3', '0858 1471 8890');
        $companyInfo->company_email = \App\Models\Setting::getValue('company_email', 'info@zdxcargo.com');
        $companyInfo->company_facebook = \App\Models\Setting::getValue('company_facebook', 'https://facebook.com/zdxcargo');
        $companyInfo->company_instagram = \App\Models\Setting::getValue('company_instagram', 'https://instagram.com/zdxcargo');
        $companyInfo->company_twitter = \App\Models\Setting::getValue('company_twitter', '');
        
        return view('contact', compact('seoData', 'companyInfo'));
    }
    
    /**
     * Halaman Komoditas
     */
    public function commodity()
    {
        $seoData = $this->getSeoData('komoditas');
        $commodities = \App\Models\Commodity::all();
        return view('commodity', compact('seoData', 'commodities'));
    }
    
    /**
     * Halaman Blog
     */
    public function blogs()
    {
        $seoData = $this->getSeoData('blogs');
        
        // Meningkatkan data SEO khusus untuk halaman blog
        $seoData['title'] = $seoData['title'] ?? 'Blog - PT. Zindan Diantar Express';
        $seoData['description'] = $seoData['description'] ?? 'Blog artikel terbaru dari PT. Zindan Diantar Express. Informasi seputar logistik, pengiriman, dan perkembangan industri.';
        $seoData['keywords'] = $seoData['keywords'] ?? 'blog, artikel, zdx express, pengiriman, logistik, cargo, ekspedisi';
        $seoData['og_title'] = $seoData['og_title'] ?? 'Blog - PT. Zindan Diantar Express';
        $seoData['og_description'] = $seoData['og_description'] ?? 'Blog artikel terbaru dari PT. Zindan Diantar Express. Informasi seputar logistik, pengiriman, dan perkembangan industri.';
        $seoData['twitter_title'] = $seoData['twitter_title'] ?? 'Blog - PT. Zindan Diantar Express';
        $seoData['twitter_description'] = $seoData['twitter_description'] ?? 'Blog artikel terbaru dari PT. Zindan Diantar Express. Informasi seputar logistik, pengiriman, dan perkembangan industri.';
        $seoData['canonical_url'] = url('/blog');
        
        // Tambahkan schema.org JSON-LD jika belum ada
        if (empty($seoData['custom_schema'])) {
            // Schema akan ditangani di view melalui conditional rendering
        }
        
        // Mengambil semua blog yang dipublikasikan dari database
        $blogs = Blog::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->paginate(9);
        
        return view('blogs', compact('seoData', 'blogs'));
    }
    
    /**
     * Halaman Detail Blog
     */
    public function blogDetail($slug)
    {
        // Mencari blog berdasarkan slug
        $blog = Blog::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();
            
        // Cek apakah ada pengaturan SEO khusus untuk blog ini
        $blogIdentifier = 'blog-' . $slug;
        $seoData = $this->getSeoData($blogIdentifier);
        
        // Jika blog memiliki gambar, gunakan sebagai og:image
        if ($blog->image) {
            $seoData['og_image'] = asset($blog->image);
        }
        
        // Canonical URL langsung ke slug, bukan /blog/slug
        $seoData['canonical_url'] = url($blog->slug);
        
        // Mengambil blog terkait berdasarkan kategori (jika ada)
        $relatedBlogs = collect();
        if ($blog->category) {
            $relatedBlogs = Blog::where('status', 'published')
                ->where('id', '!=', $blog->id)
                ->where('category', $blog->category)
                ->orderBy('published_at', 'desc')
                ->limit(3)
                ->get();
        }
        
        // Jika tidak ada blog terkait berdasarkan kategori, ambil blog terbaru
        if ($relatedBlogs->isEmpty()) {
            $relatedBlogs = Blog::where('status', 'published')
                ->where('id', '!=', $blog->id)
                ->orderBy('published_at', 'desc')
                ->limit(3)
                ->get();
        }
        
        // Mengambil artikel terbaru untuk sidebar
        $recentBlogs = Blog::where('status', 'published')
            ->where('id', '!=', $blog->id)
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();
        
        return view('blog-detail', compact('blog', 'seoData', 'relatedBlogs', 'recentBlogs'));
    }
    
    /**
     * Halaman Blog berdasarkan Kategori
     */
    public function blogByCategory($category)
    {
        $seoData = $this->getSeoData('blogs');
        $seoData['title'] = 'Kategori: ' . ucfirst($category);
        $seoData['description'] = 'Artikel dan informasi dalam kategori ' . $category . ' dari ZDX Express.';
        $seoData['og_title'] = 'Kategori: ' . ucfirst($category) . ' - ZDX Express';
        $seoData['canonical_url'] = url('/blog/category/' . $category);
        
        // Mengambil semua blog berdasarkan kategori
        $blogs = Blog::where('status', 'published')
            ->where('category', $category)
            ->orderBy('published_at', 'desc')
            ->paginate(9);
        
        return view('blogs', compact('seoData', 'blogs', 'category'));
    }
    
    /**
     * Halaman Blog berdasarkan Tag
     */
    public function blogByTag($tag)
    {
        $seoData = $this->getSeoData('blogs');
        $seoData['title'] = 'Tag: ' . ucfirst($tag) . ' - ZDX Express';
        $seoData['description'] = 'Artikel dan informasi dengan tag ' . $tag . ' dari ZDX Express.';
        $seoData['og_title'] = 'Tag: ' . ucfirst($tag) . ' - ZDX Express';
        $seoData['canonical_url'] = url('/blog/tag/' . $tag);
        
        // Mengambil semua blog berdasarkan tag
        $blogs = Blog::where('status', 'published')
            ->whereJsonContains('tags', $tag)
            ->orderBy('published_at', 'desc')
            ->paginate(9);
        
        return view('blogs', compact('seoData', 'blogs', 'tag'));
    }
} 