<?php

namespace App\Http\Controllers;

use App\Models\PageSeoSetting;
use Illuminate\Http\Request;

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
        return view('home', compact('seoData'));
    }
    
    /**
     * Halaman Layanan
     */
    public function services()
    {
        $seoData = $this->getSeoData('services');
        return view('services', compact('seoData'));
    }
    
    /**
     * Halaman Tarif
     */
    public function rates()
    {
        $seoData = $this->getSeoData('rates');
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
} 