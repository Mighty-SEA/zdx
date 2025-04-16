<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SeoSetting;
use App\Models\PageSeo;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SeoController extends Controller
{
    /**
     * Menampilkan halaman SEO dashboard
     */
    public function index()
    {
        // Get or create SeoSettings
        $seoSettings = SeoSetting::first();
        if (!$seoSettings) {
            $seoSettings = new SeoSetting();
            $seoSettings->site_title = 'ZDX Cargo';
            $seoSettings->site_description = 'Jasa pengiriman barang terpercaya';
            $seoSettings->save();
        }
        
        // Get all page SEO settings
        $pageSettings = PageSeo::all();
        
        return view('admin.seo', compact('seoSettings', 'pageSettings'));
    }
    
    /**
     * Mendapatkan data SEO halaman tertentu
     */
    public function getPageSeo($id)
    {
        \Log::info('Page SEO requested for ID: ' . $id);
        
        $pageSeo = PageSeo::find($id);
        
        if (!$pageSeo) {
            \Log::warning('Page SEO not found for ID: ' . $id);
            return response()->json([
                'error' => 'Page SEO not found'
            ], 404);
        }
        
        \Log::info('Page SEO found: ' . json_encode($pageSeo));
        
        $response = [
            'id' => $pageSeo->id,
            'page_name' => ucwords(str_replace(['-', '/'], [' ', ' > '], $pageSeo->route ?: 'Home')),
            'route' => $pageSeo->route,
            'title' => $pageSeo->title,
            'description' => $pageSeo->description,
            'keywords' => $pageSeo->keywords,
            'og_title' => $pageSeo->og_title,
            'og_description' => $pageSeo->og_description,
            'og_image' => $pageSeo->og_image,
            'canonical_url' => $pageSeo->canonical_url,
            'is_indexed' => $pageSeo->is_indexed,
            'is_followed' => $pageSeo->is_followed,
            'custom_robots' => $pageSeo->custom_robots,
            'custom_schema' => $pageSeo->custom_schema,
        ];
        
        \Log::info('Response sent: ' . json_encode($response));
        
        return response()->json($response);
    }
    
    /**
     * Menyimpan pengaturan SEO global
     */
    public function store(Request $request)
    {
        $request->validate([
            'site_title' => 'required|string|max:255',
            'site_description' => 'nullable|string',
            'site_keywords' => 'nullable|string',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string',
            'og_image' => 'nullable|string|max:255',
            'twitter_card' => 'nullable|string|max:255',
            'google_analytics_id' => 'nullable|string',
            'meta_robots' => 'nullable|string',
        ]);
        
        $seoSettings = SeoSetting::first();
        if (!$seoSettings) {
            $seoSettings = new SeoSetting();
        }
        
        $seoSettings->site_title = $request->site_title;
        $seoSettings->site_description = $request->site_description;
        $seoSettings->site_keywords = $request->site_keywords;
        $seoSettings->og_title = $request->og_title;
        $seoSettings->og_description = $request->og_description;
        $seoSettings->og_image = $request->og_image;
        $seoSettings->twitter_card = $request->twitter_card;
        $seoSettings->google_analytics_id = $request->google_analytics_id;
        $seoSettings->meta_robots = $request->meta_robots;
        
        // Handle uploaded OG image
        if ($request->hasFile('og_image_file')) {
            $file = $request->file('og_image_file');
            $filename = 'og-image-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/seo'), $filename);
            $seoSettings->og_image = 'images/seo/' . $filename;
        }
        
        $seoSettings->save();
        
        // Generate sitemap and robots.txt if requested
        if ($request->input('generate_sitemap', '0') == '1') {
            $this->generateSitemap();
        }
        
        if ($request->input('generate_robots', '0') == '1') {
            $this->generateRobotsTxt($seoSettings->meta_robots);
        }
        
        return redirect()->back()->with('success', 'Pengaturan SEO global berhasil disimpan');
    }
    
    /**
     * Menyimpan pengaturan SEO halaman
     */
    public function storePage(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'keywords' => 'nullable|string',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string',
            'canonical_url' => 'nullable|string|max:255',
            'custom_robots' => 'nullable|string',
            'custom_schema' => 'nullable|string',
        ]);
        
        $pageSeo = PageSeo::findOrFail($id);
        
        $pageSeo->title = $request->title;
        $pageSeo->description = $request->description;
        $pageSeo->keywords = $request->keywords;
        $pageSeo->og_title = $request->og_title;
        $pageSeo->og_description = $request->og_description;
        $pageSeo->canonical_url = $request->canonical_url;
        $pageSeo->is_indexed = $request->has('is_indexed');
        $pageSeo->is_followed = $request->has('is_followed');
        $pageSeo->custom_robots = $request->custom_robots;
        $pageSeo->custom_schema = $request->custom_schema;
        
        // Handle uploaded OG image
        if ($request->hasFile('og_image_file')) {
            $file = $request->file('og_image_file');
            $filename = 'page-og-' . $pageSeo->id . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/seo/pages'), $filename);
            $pageSeo->og_image = 'images/seo/pages/' . $filename;
        }
        
        $pageSeo->save();
        
        return redirect()->back()->with('success', 'Pengaturan SEO halaman berhasil disimpan');
    }
    
    /**
     * Menyimpan pengaturan SEO halaman dengan response JSON
     */
    public function storePageApi(Request $request, $id)
    {
        try {
            \Log::info('storePageApi called for ID: ' . $id . ' with data: ' . json_encode($request->all()));
            
            $validator = validator($request->all(), [
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'keywords' => 'nullable|string',
                'canonical_url' => 'nullable|string|max:255',
                'custom_robots' => 'nullable|string',
                'custom_schema' => 'nullable|string',
            ]);
            
            if ($validator->fails()) {
                \Log::warning('Validation failed: ' . json_encode($validator->errors()));
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }
            
            $pageSeo = PageSeo::findOrFail($id);
            
            $pageSeo->title = $request->title;
            $pageSeo->description = $request->description;
            $pageSeo->keywords = $request->keywords;
            $pageSeo->canonical_url = $request->canonical_url;
            $pageSeo->is_indexed = $request->input('is_indexed') ? true : false;
            $pageSeo->is_followed = $request->input('is_followed') ? true : false;
            $pageSeo->custom_robots = $request->custom_robots;
            $pageSeo->custom_schema = $request->custom_schema;
            
            $pageSeo->save();
            
            \Log::info('Page SEO saved via API: ' . json_encode($pageSeo));
            
            return response()->json(['success' => true, 'message' => 'Berhasil disimpan']);
        } catch (\Exception $e) {
            \Log::error('Error saving page SEO via API: ' . $e->getMessage() . "\nStacktrace: " . $e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Membuat file sitemap.xml
     */
    private function generateSitemap()
    {
        // Implementasi pembuatan sitemap.xml
        // Contoh sederhana:
        $baseUrl = url('/');
        $routes = [
            '' => ['priority' => '1.0', 'changefreq' => 'daily'],
            'services' => ['priority' => '0.8', 'changefreq' => 'weekly'],
            'rates' => ['priority' => '0.8', 'changefreq' => 'weekly'],
            'tracking' => ['priority' => '0.8', 'changefreq' => 'daily'],
            'customer' => ['priority' => '0.7', 'changefreq' => 'monthly'],
            'profile' => ['priority' => '0.7', 'changefreq' => 'monthly'],
            'contact' => ['priority' => '0.7', 'changefreq' => 'monthly'],
        ];
        
        $content = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $content .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;
        
        foreach ($routes as $route => $params) {
            $url = $baseUrl . '/' . $route;
            $content .= '  <url>' . PHP_EOL;
            $content .= '    <loc>' . $url . '</loc>' . PHP_EOL;
            $content .= '    <lastmod>' . date('Y-m-d') . '</lastmod>' . PHP_EOL;
            $content .= '    <changefreq>' . $params['changefreq'] . '</changefreq>' . PHP_EOL;
            $content .= '    <priority>' . $params['priority'] . '</priority>' . PHP_EOL;
            $content .= '  </url>' . PHP_EOL;
        }
        
        $content .= '</urlset>';
        
        File::put(public_path('sitemap.xml'), $content);
    }
    
    /**
     * Membuat file robots.txt
     */
    private function generateRobotsTxt($metaRobots)
    {
        $content = 'User-agent: *' . PHP_EOL;
        
        if (strpos($metaRobots, 'noindex') !== false) {
            $content .= 'Disallow: /' . PHP_EOL;
        } else {
            $content .= 'Allow: /' . PHP_EOL;
            $content .= 'Disallow: /admin/' . PHP_EOL;
            $content .= 'Disallow: /storage/' . PHP_EOL;
            $content .= 'Disallow: /vendor/' . PHP_EOL;
        }
        
        $content .= PHP_EOL . 'Sitemap: ' . url('/sitemap.xml');
        
        File::put(public_path('robots.txt'), $content);
    }
} 