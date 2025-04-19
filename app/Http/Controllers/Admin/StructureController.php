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
            $extension = $image->getClientOriginalExtension();
            $timestamp = time();
            $filename = 'logo' . $logoNumber . '_' . $timestamp . '.' . $extension;
            $outputFilename = 'logo' . $logoNumber . '.' . $extension;
            
            // Hapus logo lama jika ada
            if (Storage::disk('public')->exists('logos/' . $outputFilename)) {
                Storage::disk('public')->delete('logos/' . $outputFilename);
            }
            
            // Hapus semua file yang mungkin memiliki pola nama yang sama
            $existingFiles = Storage::disk('public')->files('logos');
            foreach ($existingFiles as $file) {
                if (strpos($file, 'logo' . $logoNumber . '_') !== false) {
                    Storage::disk('public')->delete($file);
                }
            }
            
            // Simpan logo baru dengan timestamp untuk menghindari cache
            $path = $image->storeAs('logos', $filename, 'public');
            
            // Rename file dengan timestamp menjadi nama standar
            if (Storage::disk('public')->exists('logos/' . $filename)) {
                Storage::disk('public')->copy('logos/' . $filename, 'logos/' . $outputFilename);
            }
            
            // Jika ini logo utama (logo1), salin juga sebagai logo.png
            if ($logoNumber == '1') {
                // Hapus logo.png lama jika ada
                if (Storage::disk('public')->exists('logos/logo.png')) {
                    Storage::disk('public')->delete('logos/logo.png');
                }
                
                // Copy sebagai logo.png untuk halaman profil
                Storage::disk('public')->copy('logos/' . $filename, 'logos/logo.png');
                
                // Copy juga sebagai logo standar yang digunakan di admin dashboard
                try {
                    // Jika folder public/asset tidak ada, buat folder tersebut
                    if (!file_exists(public_path('asset'))) {
                        mkdir(public_path('asset'), 0755, true);
                    }
                    
                    // Copy file dari storage ke public/asset untuk backward compatibility
                    $storageFile = Storage::disk('public')->path('logos/'.$filename);
                    copy($storageFile, public_path('asset/logo.png'));
                } catch (\Exception $e) {
                    Log::error('Gagal menyalin logo ke public/asset: ' . $e->getMessage());
                }
            }
            
            // Clear cache untuk memperbarui tampilan
            $this->clearCache();
            
            // Tambahkan timestamp ke URL redirect untuk mengatasi cache browser
            $redirectUrl = route('admin.settings', ['#company', 'tab' => 'logos', 't' => $timestamp, 'nocache' => rand()]);
            
            // Set header untuk tidak melakukan cache
            return redirect($redirectUrl)
                ->withHeaders([
                    'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
                    'Pragma' => 'no-cache',
                    'Expires' => 'Sat, 01 Jan 2000 00:00:00 GMT',
                ])
                ->with('success', 'Logo berhasil diupload. Refresh halaman jika tampilan belum berubah.');
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
            $timestamp = time();
            $extension = $image->getClientOriginalExtension();
            
            // Hapus file lama jika ada
            Storage::disk('public')->delete('images/struktur.jpg');
            
            // Simpan dengan timestamp untuk menghindari cache
            $tempFilename = 'struktur_' . $timestamp . '.' . $extension;
            $path = $image->storeAs('images', $tempFilename, 'public');
            
            // Rename file ke nama standar
            if (Storage::disk('public')->exists('images/' . $tempFilename)) {
                Storage::disk('public')->copy('images/' . $tempFilename, 'images/struktur.jpg');
                // Storage::disk('public')->delete('images/' . $tempFilename); // Biarkan kedua file ada
            }
            
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
            $timestamp = time();
            $extension = $image->getClientOriginalExtension();
            
            // Hapus file lama jika ada
            Storage::disk('public')->delete('images/logistics.jpg');
            
            // Simpan dengan timestamp untuk menghindari cache
            $tempFilename = 'logistics_' . $timestamp . '.' . $extension;
            $path = $image->storeAs('images', $tempFilename, 'public');
            
            // Rename file ke nama standar
            if (Storage::disk('public')->exists('images/' . $tempFilename)) {
                Storage::disk('public')->copy('images/' . $tempFilename, 'images/logistics.jpg');
                // Storage::disk('public')->delete('images/' . $tempFilename); // Biarkan kedua file ada
            }
            
            // Clear cache untuk memperbarui tampilan
            $this->clearCache();

            // Tambahkan parameter nocache untuk memastikan browser tidak menggunakan cache
            $redirectUrl = url()->previous() . (strpos(url()->previous(), '?') !== false ? '&' : '?') . 'nocache=' . $timestamp;
            
            return redirect($redirectUrl)->with('success', 'Gambar logistik berhasil diupload. Refresh halaman jika tampilan belum berubah.');
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
            // Clear route cache
            Artisan::call('route:clear');
            // Clear config cache
            Artisan::call('config:clear');
            
            // Clear cache browser dengan timestamp baru
            $timestamp = time();
            Cache::put('asset_version', $timestamp, now()->addYear());
            Cache::forget('laravel_cache_company_info');
            Cache::forget('laravel_cache_profile_content');
        } catch (\Exception $e) {
            // Log error jika terjadi masalah saat membersihkan cache
            Log::error('Error clearing cache: ' . $e->getMessage());
        }
    }
} 