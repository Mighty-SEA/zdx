<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SeoSetting;
use App\Models\PageSeo;

class PageController extends Controller
{
    /**
     * Controller untuk halaman frontend dengan SEO dinamis
     */
    
    /**
     * Mendapatkan pengaturan SEO untuk halaman tertentu
     * Jika halaman menggunakan pengaturan global, akan mengembalikan pengaturan global
     */
    protected function getSeoData($route = '')
    {
        // Pengaturan SEO Global
        $globalSeo = SeoSetting::first() ?? new SeoSetting();
        
        // Cari pengaturan halaman spesifik
        $pageSeo = PageSeo::where('route', $route)->first();
        
        // Jika tidak ada pengaturan halaman atau halaman menggunakan pengaturan global
        if (!$pageSeo || $pageSeo->uses_global_settings) {
            return [
                'title' => $globalSeo->site_title,
                'description' => $globalSeo->site_description,
                'keywords' => $globalSeo->site_keywords,
                'og_title' => $globalSeo->og_title,
                'og_description' => $globalSeo->og_description,
                'og_image' => $globalSeo->og_image,
                'meta_robots' => $globalSeo->meta_robots,
                'canonical_url' => url($route),
                'custom_schema' => null
            ];
        }
        
        // Gunakan pengaturan halaman spesifik
        return [
            'title' => $pageSeo->title,
            'description' => $pageSeo->description,
            'keywords' => $pageSeo->keywords,
            'og_title' => $pageSeo->og_title ?: $pageSeo->title,
            'og_description' => $pageSeo->og_description ?: $pageSeo->description,
            'og_image' => $pageSeo->og_image,
            'meta_robots' => $pageSeo->is_indexed 
                ? ($pageSeo->is_followed ? 'index, follow' : 'index, nofollow') 
                : ($pageSeo->is_followed ? 'noindex, follow' : 'noindex, nofollow'),
            'canonical_url' => $pageSeo->canonical_url ?: url($route),
            'custom_schema' => $pageSeo->custom_schema
        ];
    }
    
    /**
     * Halaman Beranda
     */
    public function home()
    {
        $seoData = $this->getSeoData('');
        return view('home', compact('seoData'));
    }
    
    /**
     * Halaman Layanan
     */
    public function services()
    {
        $seoData = $this->getSeoData('layanan');
        return view('services', compact('seoData'));
    }
    
    /**
     * Halaman Tarif
     */
    public function rates()
    {
        $seoData = $this->getSeoData('tarif');
        return view('rates', compact('seoData'));
    }
    
    /**
     * Halaman Tracking
     */
    public function tracking()
    {
        $seoData = $this->getSeoData('tracking');
        return view('tracking', compact('seoData'));
    }
    
    /**
     * Halaman Customer
     */
    public function customer()
    {
        $seoData = $this->getSeoData('customer');
        return view('customer', compact('seoData'));
    }
    
    /**
     * Halaman Profil
     */
    public function profile()
    {
        $seoData = $this->getSeoData('profil');
        return view('profile', compact('seoData'));
    }
    
    /**
     * Halaman Kontak
     */
    public function contact()
    {
        $seoData = $this->getSeoData('kontak');
        return view('contact', compact('seoData'));
    }
} 