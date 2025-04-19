<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Artisan;

class StructureController extends Controller
{
    /**
     * Upload logo perusahaan
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadLogo(Request $request)
    {
        $request->validate([
            'logo_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'logo_number' => 'required|in:1,2,3',
        ]);

        try {
            $logoNumber = $request->logo_number;
            $image = $request->file('logo_file');
            $filename = 'logo' . $logoNumber . '.' . $image->getClientOriginalExtension();
            
            // Simpan ke folder public/asset
            $image->move(public_path('asset'), $filename);
            
            // Jika ini logo utama (logo1), salin juga sebagai logo.png
            if ($logoNumber == '1') {
                // Copy juga sebagai logo.png untuk halaman profil
                File::copy(public_path('asset/' . $filename), public_path('asset/logo.png'));
            }
            
            // Clear cache untuk memperbarui tampilan
            $this->clearCache();
            
            // Tambahkan timestamp ke URL redirect untuk mengatasi cache browser
            $redirectUrl = route('admin.settings', ['#company', 'tab' => 'logos', 't' => time()]);
            
            return redirect($redirectUrl)->with('success', 'Logo berhasil diupload. Refresh halaman jika tampilan belum berubah.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengupload logo: ' . $e->getMessage());
        }
    }

    /**
     * Upload struktur organisasi
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadStructure(Request $request)
    {
        $request->validate([
            'structure_file' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            $image = $request->file('structure_file');
            
            // Simpan ke folder public/asset dengan nama struktur.jpg
            $image->move(public_path('asset'), 'struktur.jpg');
            
            // Clear cache untuk memperbarui tampilan
            $this->clearCache();

            return redirect()->back()->with('success', 'Struktur organisasi berhasil diupload. Refresh halaman jika tampilan belum berubah.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengupload struktur organisasi: ' . $e->getMessage());
        }
    }
    
    /**
     * Upload gambar logistik untuk halaman profil
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadLogistics(Request $request)
    {
        $request->validate([
            'logistics_file' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            $image = $request->file('logistics_file');
            
            // Simpan ke folder public/asset dengan nama logistics.jpg
            $image->move(public_path('asset'), 'logistics.jpg');
            
            // Clear cache untuk memperbarui tampilan
            $this->clearCache();

            return redirect()->back()->with('success', 'Gambar logistik berhasil diupload. Refresh halaman jika tampilan belum berubah.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengupload gambar logistik: ' . $e->getMessage());
        }
    }
    
    /**
     * Membersihkan cache aplikasi
     */
    private function clearCache()
    {
        try {
            // Clear cache aplikasi
            Artisan::call('cache:clear');
            // Clear view cache
            Artisan::call('view:clear');
            
            // Clear cache browser dengan timestamp baru
            $timestamp = time();
            Cache::put('asset_version', $timestamp, now()->addYear());
            
            // Force browser untuk memperbarui gambar dengan menyentuh file
            if (file_exists(public_path('asset/logo1.png'))) {
                touch(public_path('asset/logo1.png'));
            }
            
            if (file_exists(public_path('asset/logo2.png'))) {
                touch(public_path('asset/logo2.png'));
            }
            
            if (file_exists(public_path('asset/logo3.png'))) {
                touch(public_path('asset/logo3.png'));
            }
            
            if (file_exists(public_path('asset/logo.png'))) {
                touch(public_path('asset/logo.png'));
            }
            
            if (file_exists(public_path('asset/logistics.jpg'))) {
                touch(public_path('asset/logistics.jpg'));
            }
        } catch (\Exception $e) {
            // Log error jika terjadi masalah saat membersihkan cache
            Log::error('Error clearing cache: ' . $e->getMessage());
        }
    }
} 