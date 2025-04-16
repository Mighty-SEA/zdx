<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SeoSetting;
use App\Models\PageSeo;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;

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
            'uses_global_settings' => $pageSeo->uses_global_settings,
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
        \Log::info('Received page SEO form data: ' . json_encode($request->all()));
        
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'keywords' => 'nullable|string',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string',
            'canonical_url' => 'nullable|string|max:255',
            'custom_robots' => 'nullable|string',
            'custom_schema' => 'nullable|string',
            'uses_global_settings' => 'nullable',
        ]);
        
        $pageSeo = PageSeo::findOrFail($id);
        
        // Log nilai uses_global_settings yang diterima
        \Log::info('uses_global_settings value: ' . $request->input('uses_global_settings'));
        
        // Set uses_global_settings (convert to boolean)
        $pageSeo->uses_global_settings = filter_var($request->input('uses_global_settings', '0'), FILTER_VALIDATE_BOOLEAN);
        
        // Log nilai uses_global_settings setelah dikonversi
        \Log::info('uses_global_settings after conversion: ' . ($pageSeo->uses_global_settings ? 'true' : 'false'));
        
        // Set nilai lainnya jika tidak menggunakan pengaturan global
        if (!$pageSeo->uses_global_settings) {
            $pageSeo->title = $request->input('title');
            $pageSeo->description = $request->input('description');
            $pageSeo->keywords = $request->input('keywords');
            $pageSeo->og_title = $request->input('og_title');
            $pageSeo->og_description = $request->input('og_description');
            $pageSeo->canonical_url = $request->input('canonical_url');
            $pageSeo->is_indexed = $request->has('is_indexed');
            $pageSeo->is_followed = $request->has('is_followed');
            $pageSeo->custom_robots = $request->input('custom_robots');
            $pageSeo->custom_schema = $request->input('custom_schema');
            
            // Handle uploaded OG image
            if ($request->hasFile('og_image_file')) {
                $file = $request->file('og_image_file');
                $filename = 'page-og-' . $pageSeo->id . '-' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/seo/pages'), $filename);
                $pageSeo->og_image = 'images/seo/pages/' . $filename;
            }
        }
        
        // Save the model whether it's using global settings or not
        $pageSeo->save();
        
        \Log::info('Saved page SEO: ' . json_encode($pageSeo->toArray()));
        
        return redirect()->back()->with('success', 'Pengaturan SEO halaman berhasil disimpan. Mode: ' . 
            ($pageSeo->uses_global_settings ? 'Pengaturan Global' : 'Pengaturan Independen'));
    }
    
    /**
     * Menyimpan pengaturan SEO halaman dengan response JSON
     */
    public function storePageApi(Request $request, $id)
    {
        try {
            \Log::info('storePageApi called for ID: ' . $id . ' with data: ' . json_encode($request->all()));
            
            $validator = validator($request->all(), [
                'title' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'keywords' => 'nullable|string',
                'canonical_url' => 'nullable|string|max:255',
                'custom_robots' => 'nullable|string',
                'custom_schema' => 'nullable|string',
                'uses_global_settings' => 'nullable|boolean',
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
            
            // Set semua field ke null jika menggunakan pengaturan global
            if ($request->has('uses_global_settings') && $request->uses_global_settings) {
                $pageSeo->uses_global_settings = true;
            } else {
                $pageSeo->uses_global_settings = false;
                $pageSeo->title = $request->title;
                $pageSeo->description = $request->description;
                $pageSeo->keywords = $request->keywords;
                $pageSeo->canonical_url = $request->canonical_url;
                $pageSeo->is_indexed = $request->input('is_indexed') ? true : false;
                $pageSeo->is_followed = $request->input('is_followed') ? true : false;
                $pageSeo->custom_robots = $request->custom_robots;
                $pageSeo->custom_schema = $request->custom_schema;
            }
            
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
    
    /**
     * Mendapatkan data SEO untuk halaman spesifik
     */
    public function getPageData($id)
    {
        $pageSeo = PageSeo::findOrFail($id);
        
        return response()->json([
            'title' => $pageSeo->title,
            'description' => $pageSeo->description,
            'keywords' => $pageSeo->keywords,
            'meta_robots' => $pageSeo->meta_robots,
            'og_title' => $pageSeo->og_title,
            'og_description' => $pageSeo->og_description,
            'og_image' => $pageSeo->og_image,
            'canonical_url' => $pageSeo->canonical_url,
            'custom_robots' => $pageSeo->custom_robots,
            'custom_schema' => $pageSeo->custom_schema
        ]);
    }
    
    /**
     * Mendapatkan laporan SEO
     */
    public function getSeoReport()
    {
        try {
            // Get global settings
            $seoSettings = SeoSetting::first();
            $pageSettings = PageSeo::all();
            
            // Initialize scores
            $totalScore = 0;
            $factors = 0;
            $scoreBreakdown = [];
            
            // Check global settings
            if ($seoSettings) {
                // Title length (ideal: 30-60 chars)
                $titleLength = strlen($seoSettings->site_title);
                $titleScore = 0;
                if ($titleLength >= 30 && $titleLength <= 60) $titleScore = 100;
                elseif ($titleLength >= 20 && $titleLength <= 70) $titleScore = 75;
                elseif ($titleLength > 0) $titleScore = 50;
                
                $totalScore += $titleScore;
                $factors++;
                $scoreBreakdown['global_title'] = $titleScore;
                
                // Description length (ideal: 120-160 chars)
                $descLength = strlen($seoSettings->site_description);
                $descScore = 0;
                if ($descLength >= 120 && $descLength <= 160) $descScore = 100;
                elseif ($descLength >= 100 && $descLength <= 180) $descScore = 75;
                elseif ($descLength > 0) $descScore = 50;
                
                $totalScore += $descScore;
                $factors++;
                $scoreBreakdown['global_description'] = $descScore;
                
                // Keywords presence and quality
                $keywordsScore = 0;
                if (!empty($seoSettings->site_keywords)) {
                    $keywordsScore += 50;
                    
                    $keywordsArray = explode(',', $seoSettings->site_keywords);
                    if (count($keywordsArray) >= 3) $keywordsScore += 25;
                    if (count($keywordsArray) >= 5) $keywordsScore += 25;
                }
                $totalScore += $keywordsScore;
                $factors++;
                $scoreBreakdown['global_keywords'] = $keywordsScore;
                
                // OG tags presence
                $ogScore = 0;
                if (!empty($seoSettings->og_title)) $ogScore += 25;
                if (!empty($seoSettings->og_description)) $ogScore += 25;
                if (!empty($seoSettings->og_image)) $ogScore += 50;
                $totalScore += $ogScore;
                $factors++;
                $scoreBreakdown['global_og_tags'] = $ogScore;
            }
            
            // Check sitemap.xml
            $sitemapScore = file_exists(public_path('sitemap.xml')) ? 100 : 0;
            $totalScore += $sitemapScore;
            $factors++;
            $scoreBreakdown['sitemap_xml'] = $sitemapScore;
            
            // Check robots.txt
            $robotsScore = file_exists(public_path('robots.txt')) ? 100 : 0;
            $totalScore += $robotsScore;
            $factors++;
            $scoreBreakdown['robots_txt'] = $robotsScore;
            
            // Calculate page-specific scores for all pages
            $totalPages = $pageSettings->count();
            $independentPageScores = [];
            $pagesWithSeo = 0;
            
            if ($totalPages > 0) {
                foreach ($pageSettings as $page) {
                    $pageScore = 0;
                    $pageFactors = 0;
                    $pageName = ucwords(str_replace(['-', '/'], [' ', ' > '], $page->route ?: 'Home'));
                    
                    // Skip pages using global settings for detailed scoring
                    if ($page->uses_global_settings) {
                        // For pages using global settings, consider them as having complete SEO if global settings are good
                        if ($seoSettings && !empty($seoSettings->site_title) && !empty($seoSettings->site_description)) {
                            $pagesWithSeo++;
                        }
                        continue;
                    }
                    
                    // Count this as an independent page
                    if (!empty($page->title) && !empty($page->description)) {
                        $pagesWithSeo++;
                    }
                    
                    // Calculate page-specific score for independent pages
                    
                    // Title length (ideal: 30-60 chars)
                    $titleLength = strlen($page->title);
                    if ($titleLength >= 30 && $titleLength <= 60) $pageScore += 100;
                    elseif ($titleLength >= 20 && $titleLength <= 70) $pageScore += 75;
                    elseif ($titleLength > 0) $pageScore += 50;
                    else $pageScore += 0;
                    $pageFactors++;
                    
                    // Description length (ideal: 120-160 chars)
                    $descLength = strlen($page->description);
                    if ($descLength >= 120 && $descLength <= 160) $pageScore += 100;
                    elseif ($descLength >= 100 && $descLength <= 180) $pageScore += 75;
                    elseif ($descLength > 0) $pageScore += 50;
                    else $pageScore += 0;
                    $pageFactors++;
                    
                    // Keywords presence
                    if (!empty($page->keywords)) {
                        $pageScore += 100;
                    }
                    $pageFactors++;
                    
                    // OG tags presence
                    $ogPageScore = 0;
                    if (!empty($page->og_title)) $ogPageScore += 25;
                    if (!empty($page->og_description)) $ogPageScore += 25;
                    if (!empty($page->og_image)) $ogPageScore += 50;
                    $pageScore += $ogPageScore;
                    $pageFactors++;
                    
                    // Meta robots tags presence
                    if (!empty($page->custom_robots)) {
                        $pageScore += 100;
                    }
                    $pageFactors++;
                    
                    // Calculate final page score
                    $finalPageScore = $pageFactors > 0 ? round($pageScore / $pageFactors) : 0;
                    $independentPageScores[$page->id] = [
                        'name' => $pageName,
                        'score' => $finalPageScore
                    ];
                    
                    // Log score breakdown for this page
                    \Log::info("SEO Score for page '{$pageName}': {$finalPageScore}");
                }
            }
            
            // Add page coverage score to total score
            $pageCoverageScore = $totalPages > 0 ? ($pagesWithSeo / $totalPages) * 100 : 0;
            $totalScore += $pageCoverageScore;
            $factors++;
            $scoreBreakdown['page_coverage'] = $pageCoverageScore;
            
            // Calculate average score for independent pages
            if (!empty($independentPageScores)) {
                $avgIndependentScore = array_sum(array_column($independentPageScores, 'score')) / count($independentPageScores);
                $totalScore += $avgIndependentScore;
                $factors++;
                $scoreBreakdown['independent_pages_avg'] = $avgIndependentScore;
            }
            
            // Calculate final score
            $finalScore = $factors > 0 ? round($totalScore / $factors) : 0;
            
            // Log the SEO score breakdown
            \Log::info("SEO Score Breakdown: " . json_encode($scoreBreakdown));
            \Log::info("Final SEO Score: " . $finalScore);
            
            // Get previous score from cache to calculate change
            $previousScore = Cache::get('seo_previous_score', $finalScore);
            $scoreChange = $finalScore - $previousScore;
            
            // Store current score for next comparison
            Cache::put('seo_previous_score', $finalScore, now()->addDays(7));
            
            // Get keyword rankings
            $keywordRankings = $this->getKeywordRankings();
            
            // Calculate keyword change
            $previousKeywordCount = Cache::get('seo_previous_keyword_count', count($keywordRankings));
            $keywordChange = count($keywordRankings) - $previousKeywordCount;
            Cache::put('seo_previous_keyword_count', count($keywordRankings), now()->addDays(7));
            
            // Get backlinks count
            $backlinksCount = $this->getBacklinksCount();
            
            // Calculate backlinks change
            $previousBacklinksCount = Cache::get('seo_previous_backlinks', $backlinksCount);
            $backlinksChange = $backlinksCount - $previousBacklinksCount;
            Cache::put('seo_previous_backlinks', $backlinksCount, now()->addDays(7));
            
            // Get page speed score
            $pageSpeedScore = $this->getPageSpeedScore();
            
            // Calculate page speed change
            $previousPageSpeed = Cache::get('seo_previous_pagespeed', $pageSpeedScore);
            $pageSpeedChange = $pageSpeedScore - $previousPageSpeed;
            Cache::put('seo_previous_pagespeed', $pageSpeedScore, now()->addDays(7));
            
            return response()->json([
                'success' => true,
                'data' => [
                    'seo_score' => $finalScore,
                    'score_change' => $scoreChange,
                    'keywords_ranking' => count($keywordRankings),
                    'keywords_change' => $keywordChange,
                    'backlinks' => $backlinksCount,
                    'backlinks_change' => $backlinksChange,
                    'page_speed' => $pageSpeedScore,
                    'page_speed_change' => $pageSpeedChange,
                    'score_breakdown' => $scoreBreakdown,
                    'page_scores' => $independentPageScores,
                    'optimization_tips' => $this->getOptimizationTips($finalScore, $seoSettings, $pageSettings)
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Error getting SEO report: ' . $e->getMessage() . "\nStacktrace: " . $e->getTraceAsString());
            return response()->json([
                'success' => false,
                'message' => 'Error getting SEO report: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get keyword rankings
     */
    private function getKeywordRankings()
    {
        // Implementasi untuk mendapatkan data peringkat kata kunci dari website
        try {
            $seoSettings = SeoSetting::first();
            $keywords = [];
            
            if ($seoSettings && !empty($seoSettings->site_keywords)) {
                $keywordsArray = explode(',', $seoSettings->site_keywords);
                foreach ($keywordsArray as $index => $keyword) {
                    $keyword = trim($keyword);
                    if (!empty($keyword)) {
                        // Simulasi peringkat kata kunci - dalam implementasi nyata,
                        // ini akan terhubung ke Google Search Console API atau serupa
                        $keywords[] = [
                            'keyword' => $keyword,
                            'position' => rand(1, 20), // Simulasi posisi 1-20
                            'volume' => rand(100, 5000) // Simulasi volume pencarian bulanan
                        ];
                    }
                }
            }
            
            return $keywords;
        } catch (\Exception $e) {
            \Log::error('Error getting keyword rankings: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Get backlinks count
     */
    private function getBacklinksCount()
    {
        try {
            // Implementasi untuk mendapatkan jumlah backlink ke website
            // Dalam implementasi nyata, ini akan terhubung ke API Moz, Ahrefs, atau Majestic
            
            // Cek jika ada data sebelumnya di cache
            if (Cache::has('seo_backlinks_count')) {
                $previousCount = Cache::get('seo_backlinks_count');
                // Simulasi perubahan kecil dalam jumlah backlink
                $variation = rand(-5, 15);
                $count = max(0, $previousCount + $variation);
            } else {
                // Nilai awal jika tidak ada di cache
                $count = rand(50, 200);
            }
            
            // Simpan nilai saat ini ke cache
            Cache::put('seo_backlinks_count', $count, now()->addDay());
            
            return $count;
        } catch (\Exception $e) {
            \Log::error('Error getting backlinks count: ' . $e->getMessage());
            return 0;
        }
    }

    /**
     * Get page speed score
     */
    private function getPageSpeedScore()
    {
        try {
            // Implementasi untuk mendapatkan skor kecepatan halaman
            // Dalam implementasi nyata, ini akan terhubung ke Google PageSpeed Insights API
            
            // Cek jika ada data sebelumnya di cache
            if (Cache::has('seo_pagespeed_score')) {
                $previousScore = Cache::get('seo_pagespeed_score');
                // Simulasi perubahan kecil dalam skor
                $variation = rand(-3, 5);
                $score = min(100, max(1, $previousScore + $variation));
            } else {
                // Nilai awal jika tidak ada di cache
                $score = rand(70, 95);
            }
            
            // Simpan nilai saat ini ke cache
            Cache::put('seo_pagespeed_score', $score, now()->addDay());
            
            return $score;
        } catch (\Exception $e) {
            \Log::error('Error getting page speed score: ' . $e->getMessage());
            return 0;
        }
    }

    /**
     * Get optimization tips based on current scores
     */
    private function getOptimizationTips($score, $seoSettings, $pageSettings)
    {
        $tips = [];
        
        // Check title length
        if (!$seoSettings || empty($seoSettings->site_title)) {
            $tips[] = [
                'type' => 'error',
                'message' => 'Judul website belum diatur. Tambahkan judul website untuk meningkatkan SEO.'
            ];
        } elseif (strlen($seoSettings->site_title) < 30 || strlen($seoSettings->site_title) > 60) {
            $tips[] = [
                'type' => 'warning',
                'message' => 'Panjang judul website sebaiknya antara 30-60 karakter untuk hasil optimal'
            ];
        }
        
        // Check description length
        if (!$seoSettings || empty($seoSettings->site_description)) {
            $tips[] = [
                'type' => 'error',
                'message' => 'Deskripsi website belum diatur. Tambahkan deskripsi website untuk meningkatkan SEO.'
            ];
        } elseif (strlen($seoSettings->site_description) < 120 || strlen($seoSettings->site_description) > 160) {
            $tips[] = [
                'type' => 'warning',
                'message' => 'Panjang deskripsi website sebaiknya antara 120-160 karakter'
            ];
        }
        
        // Check keywords
        if (!$seoSettings || empty($seoSettings->site_keywords)) {
            $tips[] = [
                'type' => 'error',
                'message' => 'Kata kunci website belum diatur. Tambahkan kata kunci yang relevan.'
            ];
        } elseif (substr_count($seoSettings->site_keywords, ',') < 2) {
            $tips[] = [
                'type' => 'warning',
                'message' => 'Tambahkan lebih banyak kata kunci yang relevan untuk meningkatkan visibilitas.'
            ];
        }
        
        // Check OG tags
        if (!$seoSettings || empty($seoSettings->og_title)) {
            $tips[] = [
                'type' => 'warning',
                'message' => 'Tambahkan judul Open Graph untuk meningkatkan tampilan di media sosial'
            ];
        }
        
        if (!$seoSettings || empty($seoSettings->og_description)) {
            $tips[] = [
                'type' => 'warning',
                'message' => 'Tambahkan deskripsi Open Graph untuk meningkatkan tampilan di media sosial'
            ];
        }
        
        if (!$seoSettings || empty($seoSettings->og_image)) {
            $tips[] = [
                'type' => 'error',
                'message' => 'Tambahkan gambar Open Graph untuk meningkatkan tampilan di media sosial'
            ];
        }
        
        // Check sitemap
        if (!file_exists(public_path('sitemap.xml'))) {
            $tips[] = [
                'type' => 'error',
                'message' => 'Sitemap.xml belum dibuat. Generate sitemap untuk membantu indexing'
            ];
        }
        
        // Check robots.txt
        if (!file_exists(public_path('robots.txt'))) {
            $tips[] = [
                'type' => 'error',
                'message' => 'File robots.txt belum dibuat. Generate file robots.txt untuk mengontrol crawler'
            ];
        }
        
        // Check pages with missing SEO
        $pagesWithMissingSeo = [];
        $pagesMissingKeywords = [];
        $pagesMissingOgTags = [];
        
        foreach ($pageSettings as $page) {
            $pageName = ucwords(str_replace(['-', '/'], [' ', ' > '], $page->route ?: 'Home'));
            
            // Skip pages using global settings if global settings are complete
            if ($page->uses_global_settings && $seoSettings && 
                !empty($seoSettings->site_title) && !empty($seoSettings->site_description)) {
                continue;
            }
            
            // Check for missing title/description
            if (($page->uses_global_settings && (!$seoSettings || empty($seoSettings->site_title) || empty($seoSettings->site_description))) ||
                (!$page->uses_global_settings && (empty($page->title) || empty($page->description)))) {
                $pagesWithMissingSeo[] = $pageName;
            }
            
            // For independent pages, check keywords and OG tags
            if (!$page->uses_global_settings) {
                // Check missing keywords
                if (empty($page->keywords)) {
                    $pagesMissingKeywords[] = $pageName;
                }
                
                // Check missing OG tags
                if (empty($page->og_title) || empty($page->og_description) || empty($page->og_image)) {
                    $pagesMissingOgTags[] = $pageName;
                }
            }
        }
        
        // Add tips for pages missing basic SEO
        if (!empty($pagesWithMissingSeo)) {
            $tips[] = [
                'type' => 'error',
                'message' => count($pagesWithMissingSeo) > 1 
                    ? 'Halaman ' . implode(', ', array_slice($pagesWithMissingSeo, 0, 3)) . (count($pagesWithMissingSeo) > 3 ? ' dan ' . (count($pagesWithMissingSeo) - 3) . ' lainnya' : '') . ' belum memiliki judul atau deskripsi'
                    : 'Halaman ' . $pagesWithMissingSeo[0] . ' belum memiliki judul atau deskripsi'
            ];
        }
        
        // Add tips for pages missing keywords
        if (!empty($pagesMissingKeywords)) {
            $tips[] = [
                'type' => 'warning',
                'message' => count($pagesMissingKeywords) > 1 
                    ? 'Halaman ' . implode(', ', array_slice($pagesMissingKeywords, 0, 3)) . (count($pagesMissingKeywords) > 3 ? ' dan ' . (count($pagesMissingKeywords) - 3) . ' lainnya' : '') . ' belum memiliki kata kunci'
                    : 'Halaman ' . $pagesMissingKeywords[0] . ' belum memiliki kata kunci'
            ];
        }
        
        // Add tips for pages missing OG tags
        if (!empty($pagesMissingOgTags)) {
            $tips[] = [
                'type' => 'warning',
                'message' => count($pagesMissingOgTags) > 1 
                    ? 'Halaman ' . implode(', ', array_slice($pagesMissingOgTags, 0, 3)) . (count($pagesMissingOgTags) > 3 ? ' dan ' . (count($pagesMissingOgTags) - 3) . ' lainnya' : '') . ' belum memiliki tag Open Graph yang lengkap'
                    : 'Halaman ' . $pagesMissingOgTags[0] . ' belum memiliki tag Open Graph yang lengkap'
            ];
        }
        
        // Add overall score-based tips
        if ($score < 50) {
            $tips[] = [
                'type' => 'error',
                'message' => 'Skor SEO website sangat rendah. Perhatikan tips di atas untuk meningkatkan skor.'
            ];
        } elseif ($score < 70) {
            $tips[] = [
                'type' => 'warning',
                'message' => 'Skor SEO website cukup rendah. Ada banyak ruang untuk peningkatan.'
            ];
        } elseif ($score >= 90) {
            $tips[] = [
                'type' => 'success',
                'message' => 'Selamat! Skor SEO website sangat baik. Pertahankan kualitas ini.'
            ];
        } elseif ($score >= 80) {
            $tips[] = [
                'type' => 'success',
                'message' => 'Skor SEO website sudah baik. Lakukan sedikit perbaikan untuk hasil maksimal.'
            ];
        }
        
        return $tips;
    }
} 