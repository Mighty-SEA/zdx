<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Controller untuk halaman frontend
     */
    
    /**
     * Mendapatkan data SEO dasar untuk halaman
     */
    protected function getSeoData($route = '')
    {
        return [
            'title' => 'ZDX Express - Jasa Pengiriman Cepat & Terpercaya',
            'description' => 'ZDX Express menyediakan layanan pengiriman cepat, aman, dan terpercaya ke seluruh Indonesia. Dapatkan tarif terbaik dan tracking real-time.',
            'keywords' => 'jasa pengiriman, ekspedisi, kurir, pengiriman barang, tracking paket',
            'og_title' => 'ZDX Express - Jasa Pengiriman Cepat & Terpercaya',
            'og_description' => 'ZDX Express menyediakan layanan pengiriman cepat, aman, dan terpercaya ke seluruh Indonesia.',
            'og_image' => asset('images/og-image.jpg'),
            'meta_robots' => 'index, follow',
            'canonical_url' => url($route),
            'custom_schema' => null
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