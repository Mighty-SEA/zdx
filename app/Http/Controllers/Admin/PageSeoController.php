<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageSeoSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

class PageSeoController extends Controller
{
    /**
     * Display a listing of the page SEO settings
     */
    public function index()
    {
        $pageSettings = PageSeoSetting::all();
        return view('admin.seo.index', compact('pageSettings'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pageSeo = PageSeoSetting::findOrFail($id);
        return view('admin.seo.edit', compact('pageSeo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'nullable|max:100',
            'description' => 'nullable|max:255',
            'keywords' => 'nullable|max:255',
            'og_title' => 'nullable|max:100',
            'og_description' => 'nullable|max:255',
            'og_image' => 'nullable|max:255',
            'custom_robots' => 'nullable|max:100',
            'custom_schema' => 'nullable',
            'uses_global_settings' => 'boolean'
        ]);

        $pageSeo = PageSeoSetting::findOrFail($id);
        
        // Upload file image jika ada
        if ($request->hasFile('og_image_file')) {
            // Pastikan direktori ada
            $imgPath = public_path('images/seo');
            if (!file_exists($imgPath)) {
                mkdir($imgPath, 0755, true);
            }
            
            $file = $request->file('og_image_file');
            $filename = 'og-image-' . $pageSeo->page_identifier . '.' . $file->getClientOriginalExtension();
            $file->move($imgPath, $filename);
            $request->merge(['og_image' => 'images/seo/' . $filename]);
        }

        $pageSeo->update($request->all());

        return redirect()->route('admin.seo.edit', $pageSeo->id)->with('success', 'Pengaturan SEO halaman berhasil diperbarui');
    }

    /**
     * Initialize default SEO settings for all pages
     */
    public function initializeDefaults()
    {
        $defaultPages = [
            [
                'page_identifier' => 'home',
                'page_name' => 'Beranda',
                'title' => 'ZDX Express - Jasa Pengiriman Cepat & Terpercaya',
                'description' => 'ZDX Express menyediakan layanan pengiriman cepat, aman, dan terpercaya ke seluruh Indonesia. Dapatkan tarif terbaik dan tracking real-time.',
                'keywords' => 'jasa pengiriman, ekspedisi, kurir, pengiriman barang, tracking paket',
            ],
            [
                'page_identifier' => 'services',
                'page_name' => 'Layanan',
            ],
            [
                'page_identifier' => 'rates',
                'page_name' => 'Tarif',
            ],
            [
                'page_identifier' => 'tracking',
                'page_name' => 'Tracking',
            ],
            [
                'page_identifier' => 'customer',
                'page_name' => 'Customer',
            ],
            [
                'page_identifier' => 'komoditas',
                'page_name' => 'Komoditas',
                'title' => 'Komoditas - ZDX Express',
                'description' => 'Jenis komoditas yang dapat dikirim melalui layanan ZDX Express. Pengiriman aman dan terpercaya untuk berbagai jenis komoditas.',
                'keywords' => 'komoditas, barang, pengiriman, cargo, zdx express',
            ],
            [
                'page_identifier' => 'profile',
                'page_name' => 'Profil',
            ],
            [
                'page_identifier' => 'contact',
                'page_name' => 'Kontak',
            ],
            [
                'page_identifier' => 'blogs',
                'page_name' => 'Blog',
                'title' => 'Blog - PT. Zindan Diantar Express',
                'description' => 'Blog artikel terbaru dari PT. Zindan Diantar Express. Informasi seputar logistik, pengiriman, dan perkembangan industri.',
                'keywords' => 'blog, artikel, zdx express, pengiriman, logistik, cargo, ekspedisi',
            ],
        ];

        foreach ($defaultPages as $page) {
            PageSeoSetting::updateOrCreate(
                ['page_identifier' => $page['page_identifier']],
                $page
            );
        }

        // Tambahkan semua layanan ke pengaturan SEO
        $this->syncServicePages();

        return redirect()->route('admin.seo')->with('success', 'Pengaturan SEO default berhasil diinisialisasi');
    }

    /**
     * Sync service pages with SEO settings
     */
    public function syncServicePages()
    {
        // Dapatkan semua layanan yang dipublikasikan
        $services = \App\Models\Service::where('status', 'published')->get();
        
        // Kumpulkan semua identifier layanan yang valid
        $validServiceIdentifiers = [];
        
        foreach ($services as $service) {
            // Bentuk identifier dari layanan dengan prefix 'service-'
            $identifier = 'service-' . $service->slug;
            $validServiceIdentifiers[] = $identifier;
            
            // Cek apakah setting SEO untuk layanan ini sudah ada
            $existingSetting = PageSeoSetting::where('page_identifier', $identifier)->first();
            
            if ($existingSetting) {
                // Jika sudah ada, hanya perbarui page_name saja untuk memastikan konsistensi
                $existingSetting->update([
                    'page_name' => 'Layanan: ' . $service->title
                ]);
            } else {
                // Jika belum ada, buat pengaturan SEO baru
                PageSeoSetting::create([
                    'page_identifier' => $identifier,
                    'page_name' => 'Layanan: ' . $service->title,
                    'title' => $service->title ,
                    'description' => $service->description,
                    'keywords' => 'layanan ' . $service->title . ', jasa pengiriman, zdx express',
                    'og_title' => $service->title,
                    'og_description' => $service->description,
                    'og_image' => $service->image ? 'storage/' . $service->image : null,
                ]);
            }
        }
        
        // Hapus pengaturan SEO untuk layanan yang tidak ada lagi
        PageSeoSetting::where('page_identifier', 'like', 'service-%')
            ->whereNotIn('page_identifier', $validServiceIdentifiers)
            ->delete();
    }
    
    /**
     * Sync service pages route
     */
    public function syncServices()
    {
        $this->syncServicePages();
        $this->syncBlogPages();
        $this->syncAllPages();
        return redirect()->route('admin.seo')->with('success', 'Halaman layanan, blog, dan halaman umum berhasil disinkronkan dengan pengaturan SEO');
    }

    /**
     * Sync blog pages with SEO settings
     */
    public function syncBlogPages()
    {
        // Pastikan halaman blog utama ada
        PageSeoSetting::updateOrCreate(
            ['page_identifier' => 'blogs'],
            [
                'page_name' => 'Blog',
                'title' => 'Blog - PT. Zindan Diantar Express',
                'description' => 'Blog artikel terbaru dari PT. Zindan Diantar Express. Informasi seputar logistik, pengiriman, dan perkembangan industri.',
                'keywords' => 'blog, artikel, zdx express, pengiriman, logistik, cargo, ekspedisi',
                'canonical_url' => url('/blog')
            ]
        );
        
        // Dapatkan semua blog yang dipublikasikan
        $blogs = \App\Models\Blog::where('status', 'published')->get();
        
        // Kumpulkan semua identifier blog yang valid
        $validBlogIdentifiers = [];
        
        foreach ($blogs as $blog) {
            // Bentuk identifier dari blog dengan prefix 'blog-'
            $identifier = 'blog-' . $blog->slug;
            $validBlogIdentifiers[] = $identifier;
            
            // Cek apakah setting SEO untuk blog ini sudah ada
            $existingSetting = PageSeoSetting::where('page_identifier', $identifier)->first();
            
            if ($existingSetting) {
                // Jika sudah ada, hanya perbarui page_name saja untuk memastikan konsistensi
                $existingSetting->update([
                    'page_name' => 'Blog: ' . $blog->title
                ]);
            } else {
                // Jika belum ada, buat pengaturan SEO baru
                PageSeoSetting::create([
                    'page_identifier' => $identifier,
                    'page_name' => 'Blog: ' . $blog->title,
                    'title' => $blog->title ,
                    'description' => $blog->description,
                    'keywords' => 'blog ' . $blog->title . ', artikel, zdx express' . ($blog->category ? ', ' . $blog->category : ''),
                    'og_title' => $blog->title,
                    'og_description' => $blog->description,
                    'og_image' => $blog->image ?? null,
                    'canonical_url' => url($blog->slug),
                ]);
            }
        }
        
        // Hapus pengaturan SEO untuk blog yang tidak ada lagi
        PageSeoSetting::where('page_identifier', 'like', 'blog-%')
            ->whereNotIn('page_identifier', $validBlogIdentifiers)
            ->delete();
    }

    /**
     * Sync all valid pages and remove invalid ones
     */
    public function syncAllPages()
    {
        // Definisikan halaman-halaman default yang valid
        $validPages = [
            'home', 'services', 'rates', 'tracking', 'customer', 
            'komoditas', 'profile', 'contact', 'blogs'
        ];
        
        // Tambahkan semua identifier layanan yang valid
        $services = \App\Models\Service::where('status', 'published')->pluck('slug')->toArray();
        foreach ($services as $slug) {
            $validPages[] = 'service-' . $slug;
        }

        // Tambahkan semua identifier blog yang valid
        $blogs = \App\Models\Blog::where('status', 'published')->pluck('slug')->toArray();
        foreach ($blogs as $slug) {
            $validPages[] = 'blog-' . $slug;
        }
        
        // Hapus halaman yang tidak valid (tidak dalam daftar dan bukan halaman khusus)
        PageSeoSetting::whereNotIn('page_identifier', $validPages)
            ->where(function($query) {
                // Pastikan tidak menghapus halaman khusus yang mungkin ditambahkan secara manual
                $query->where('page_identifier', 'not like', 'custom-%')
                      ->where('page_identifier', 'not like', 'article-%')
                      ->where('page_identifier', 'not like', 'product-%');
            })
            ->delete();
    }

    /**
     * Show robots.txt editor
     */
    public function showRobots()
    {
        $robotsPath = public_path('robots.txt');
        $robotsContent = '';
        
        if (File::exists($robotsPath)) {
            $robotsContent = File::get($robotsPath);
        } else {
            // Default robots.txt content
            $robotsContent = "User-agent: *\nAllow: /\n\nSitemap: " . url('sitemap.xml');
        }
        
        return view('admin.seo.robots', compact('robotsContent'));
    }
    
    /**
     * Save robots.txt file
     */
    public function updateRobots(Request $request)
    {
        $request->validate([
            'robots_content' => 'required'
        ]);
        
        $robotsPath = public_path('robots.txt');
        File::put($robotsPath, $request->robots_content);
        
        return redirect()->route('admin.seo.robots')->with('success', 'File robots.txt berhasil diperbarui');
    }
    
    /**
     * Show sitemap editor
     */
    public function showSitemap()
    {
        $sitemapPath = public_path('sitemap.xml');
        $sitemapExists = File::exists($sitemapPath);
        $sitemapContent = '';
        
        if ($sitemapExists) {
            $sitemapContent = File::get($sitemapPath);
        }
        
        $pages = PageSeoSetting::all();
        
        return view('admin.seo.sitemap', compact('sitemapExists', 'sitemapContent', 'pages'));
    }
    
    /**
     * Generate sitemap.xml file
     */
    public function generateSitemap(Request $request)
    {
        // Generate sitemap.xml
        try {
            // Get all pages
            $pages = PageSeoSetting::all();
            
            // Start XML
            $xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
            $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;
            
            // Add home URL
            $xml .= '  <url>' . PHP_EOL;
            $xml .= '    <loc>' . url('/') . '</loc>' . PHP_EOL;
            $xml .= '    <changefreq>weekly</changefreq>' . PHP_EOL;
            $xml .= '    <priority>1.0</priority>' . PHP_EOL;
            $xml .= '  </url>' . PHP_EOL;
            
            // Add other pages
            foreach ($pages as $page) {
                if ($page->page_identifier !== 'home') {
                    // Skip if not included
                    if (!$request->has('include_' . $page->id)) {
                        continue;
                    }
                    
                    $priority = $request->input('priority_' . $page->id, '0.8');
                    $changefreq = $request->input('changefreq_' . $page->id, 'monthly');
                    
                    $xml .= '  <url>' . PHP_EOL;
                    $xml .= '    <loc>' . url($page->page_identifier) . '</loc>' . PHP_EOL;
                    $xml .= '    <changefreq>' . $changefreq . '</changefreq>' . PHP_EOL;
                    $xml .= '    <priority>' . $priority . '</priority>' . PHP_EOL;
                    $xml .= '  </url>' . PHP_EOL;
                }
            }
            
            // Add additional URLs
            if ($request->additional_urls) {
                $additionalUrls = explode("\n", $request->additional_urls);
                foreach ($additionalUrls as $url) {
                    $url = trim($url);
                    if (!empty($url)) {
                        $xml .= '  <url>' . PHP_EOL;
                        $xml .= '    <loc>' . $url . '</loc>' . PHP_EOL;
                        $xml .= '    <changefreq>monthly</changefreq>' . PHP_EOL;
                        $xml .= '    <priority>0.5</priority>' . PHP_EOL;
                        $xml .= '  </url>' . PHP_EOL;
                    }
                }
            }
            
            // Close XML
            $xml .= '</urlset>';
            
            // Save sitemap
            File::put(public_path('sitemap.xml'), $xml);
            
            return redirect()->route('admin.seo.sitemap')->with('success', 'Sitemap berhasil dibuat dan disimpan');
        } catch (\Exception $e) {
            return redirect()->route('admin.seo.sitemap')->with('error', 'Gagal menghasilkan sitemap: ' . $e->getMessage());
        }
    }
    
    /**
     * Update sitemap.xml file directly
     */
    public function updateSitemap(Request $request)
    {
        $request->validate([
            'sitemap_content' => 'required'
        ]);
        
        try {
            // Validate XML
            libxml_use_internal_errors(true);
            $xml = simplexml_load_string($request->sitemap_content);
            
            if ($xml === false) {
                $errors = libxml_get_errors();
                libxml_clear_errors();
                return redirect()->route('admin.seo.sitemap')->with('error', 'XML tidak valid: ' . $errors[0]->message);
            }
            
            File::put(public_path('sitemap.xml'), $request->sitemap_content);
            
            return redirect()->route('admin.seo.sitemap')->with('success', 'File sitemap.xml berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->route('admin.seo.sitemap')->with('error', 'Gagal memperbarui sitemap: ' . $e->getMessage());
        }
    }
} 