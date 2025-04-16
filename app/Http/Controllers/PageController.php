<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    /**
     * Controller untuk halaman frontend dengan SEO dinamis
     */
    
    /**
     * Mengambil data SEO untuk halaman tertentu
     *
     * @param string $route
     * @return array
     */
    private function getSeoData($route)
    {
        // Ambil data SEO khusus halaman dari model PageSeo
        $pageSeo = \App\Models\PageSeo::where('route', $route)->first();
        
        // Fallback ke data default jika tidak ada di database
        if (!$pageSeo) {
            return [
                'title' => ucfirst($route),
                'description' => 'ZDX Cargo - Jasa pengiriman terpercaya untuk kebutuhan logistik Anda',
                'keywords' => 'jasa pengiriman, cargo, logistik',
            ];
        }
        
        return [
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