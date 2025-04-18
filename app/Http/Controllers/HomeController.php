<?php

namespace App\Http\Controllers;

use App\Models\PageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Cek jika user dalam direct edit mode
        if (session('direct_edit_mode')) {
            View::share('direct_edit_mode', true);
        }
    }

    /**
     * Display home page
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Cek jika ada parameter preview
        $previewMode = false;
        $previewContent = null;
        
        if ($request->has('preview') && $request->preview) {
            $previewMode = true;
            $previewContent = \App\Models\PageContent::find($request->preview);
            
            if ($previewContent) {
                // Set session untuk memberitahu user bahwa ini adalah preview
                session()->flash('preview_mode', true);
                session()->flash('preview_content_id', $previewContent->id);
            }
        }
        
        // Ambil data SEO dari konfigurasi atau database
        $seoData = [
            'title' => 'ZDX Express - Jasa Pengiriman',
            'description' => 'ZDX Express menyediakan jasa pengiriman cepat, aman dan terpercaya ke seluruh Indonesia. Solusi logistik terbaik untuk bisnis Anda.',
            'keywords' => 'jasa pengiriman, cargo, ekspedisi, logistik, ekspres, cepat, aman',
            'canonical_url' => url('/'),
            'meta_robots' => 'index, follow',
            'og_title' => 'ZDX Express - Jasa Pengiriman Cepat & Terpercaya',
            'og_description' => 'Kirim barang dengan ZDX Express, layanan pengiriman terpercaya ke seluruh Indonesia.',
            'og_image' => 'asset/logo.png',
            'custom_schema' => ''
        ];

        try {
            // Coba ambil konten dari database
            $heroContent = PageContent::where('id', 1)->first(); // Ubah ini sesuai kolom yang tersedia
            $statsContent = PageContent::where('id', 2)->first(); // Ubah ini sesuai kolom yang tersedia
            
            // Jika dalam mode preview, ganti konten yang sesuai dengan konten preview
            if ($previewMode && $previewContent) {
                // Identifikasi tipe konten yang di-preview dan ganti dengan yang sesuai
                if ($previewContent->page === 'home') {
                    if ($previewContent->section === 'hero') {
                        $heroContent = $previewContent;
                    } elseif ($previewContent->section === 'stats') {
                        $statsContent = $previewContent;
                    }
                    // Tambahkan kondisi lain sesuai dengan section yang tersedia
                }
            }
        } catch (\Exception $e) {
            // Jika terjadi masalah dengan database, gunakan data JSON
            $heroContent = $this->getContentFromJson('homeContent');
            $statsContent = $this->getContentFromJson('statsContent');
        }
        
        // Fallback ke JSON jika konten tidak ditemukan
        if (empty($heroContent)) {
            $heroContent = $this->getContentFromJson('homeContent');
        }
        
        if (empty($statsContent)) {
            $statsContent = $this->getContentFromJson('statsContent');
        }

        // Ambil semua konten untuk halaman beranda yang aktif
        $contents = PageContent::where('page_key', 'home')
            ->where('is_active', true)
            ->get()
            ->keyBy('section');

        // Periksa apakah berada dalam mode edit
        $editMode = session('direct_edit_mode') === true;

        return view('home', compact('seoData', 'heroContent', 'statsContent', 'previewMode', 'previewContent', 'contents', 'editMode'));
    }
    
    /**
     * Get content from JSON file
     * 
     * @param string $filename
     * @return object
     */
    private function getContentFromJson($filename)
    {
        $path = resource_path("json/{$filename}.json");
        
        if (File::exists($path)) {
            $content = json_decode(File::get($path));
            return (object) $content;
        }
        
        return new \stdClass();
    }
}
