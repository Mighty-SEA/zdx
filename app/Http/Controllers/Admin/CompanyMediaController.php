<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CompanyMediaController extends Controller
{
    /**
     * Upload logo perusahaan ke database
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadLogo(Request $request)
    {
        $request->validate([
            'logo_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'logo_number' => 'required|in:1,2,3,title',
            'logo_alt' => 'nullable|string|max:255',
            'logo_name' => 'nullable|string|max:255',
        ]);

        try {
            $logoNumber = $request->logo_number;
            $logoAlt = $request->logo_alt ?? 'Logo ZDX Cargo';
            $image = $request->file('logo_file');
            $extension = $image->getClientOriginalExtension();
            
            // Generate nama file yang unik
            $fileName = ($request->logo_name ? Str::slug($request->logo_name) : 'logo') . '_' . time() . '.' . $extension;
            
            // Tentukan kolom yang akan diupdate
            $columnPrefix = '';
            if ($logoNumber === 'title') {
                $columnPrefix = 'title_logo';
            } else {
                $columnPrefix = 'logo_' . $logoNumber;
            }
            
            // Path untuk menyimpan gambar
            $path = $image->storeAs('company_media/logos', $fileName, 'public');
            
            // Dapatkan setting dari DB atau buat baru jika belum ada
            $setting = DB::table('settings')->first();
            if (!$setting) {
                // Buat data awal jika belum ada
                DB::table('settings')->insert([
                    'key' => 'company_info',
                    'value' => json_encode(['company_name' => 'ZDX Cargo']),
                    'group' => 'company',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                $setting = DB::table('settings')->first();
            }
            
            // Update data di tabel settings
            DB::table('settings')
                ->where('id', $setting->id)
                ->update([
                    "{$columnPrefix}_path" => 'storage/' . $path,
                    "{$columnPrefix}_name" => $request->logo_name ?? 'Logo ZDX Cargo',
                    "{$columnPrefix}_alt" => $logoAlt,
                    "{$columnPrefix}_updated_at" => now()
                ]);
            
            // Jika ini logo utama (logo_1), duplikasi ke logo.png untuk legacy support
            if ($logoNumber === '1') {
                // Menyalin juga ke folder asset untuk backward compatibility
                try {
                    // Jika folder public/asset tidak ada, buat folder tersebut
                    if (!file_exists(public_path('asset'))) {
                        mkdir(public_path('asset'), 0755, true);
                    }
                    
                    // Copy file dari storage ke public/asset untuk backward compatibility
                    $storageFile = Storage::disk('public')->path('company_media/logos/' . $fileName);
                    copy($storageFile, public_path('asset/logo.png'));
                } catch (\Exception $e) {
                    // Gagal duplikasi tidak menghentikan proses
                    Log::error('Gagal menyalin logo ke public/asset: ' . $e->getMessage());
                }
            }
            
            // Bersihkan cache
            $this->clearCache();
            
            return redirect()->route('admin.settings', ['#company', 'tab' => 'logos'])
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
            'structure_alt' => 'nullable|string|max:255',
            'structure_name' => 'nullable|string|max:255',
        ]);

        try {
            $image = $request->file('structure_file');
            $extension = $image->getClientOriginalExtension();
            $structureAlt = $request->structure_alt ?? 'Struktur Organisasi ZDX Cargo';
            
            // Generate nama file yang unik
            $fileName = ($request->structure_name ? Str::slug($request->structure_name) : 'struktur-organisasi') . '_' . time() . '.' . $extension;
            
            // Path untuk menyimpan gambar
            $path = $image->storeAs('company_media/structure', $fileName, 'public');
            
            // Dapatkan setting dari DB atau buat baru jika belum ada
            $setting = DB::table('settings')->first();
            if (!$setting) {
                // Buat data awal jika belum ada
                DB::table('settings')->insert([
                    'key' => 'company_info',
                    'value' => json_encode(['company_name' => 'ZDX Cargo']),
                    'group' => 'company',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                $setting = DB::table('settings')->first();
            }
            
            // Update data di tabel settings
            DB::table('settings')
                ->where('id', $setting->id)
                ->update([
                    "structure_image_path" => 'storage/' . $path,
                    "structure_image_name" => $request->structure_name ?? 'Struktur Organisasi',
                    "structure_image_alt" => $structureAlt,
                    "structure_image_updated_at" => now()
                ]);
            
            // Untuk backward compatibility, simpan juga di lokasi lama
            try {
                $storageFile = Storage::disk('public')->path('company_media/structure/' . $fileName);
                Storage::disk('public')->put('images/struktur.jpg', file_get_contents($storageFile));
            } catch (\Exception $e) {
                // Gagal duplikasi tidak menghentikan proses
                Log::error('Gagal menyalin struktur ke lokasi lama: ' . $e->getMessage());
            }
            
            // Bersihkan cache
            $this->clearCache();

            return redirect()->route('admin.settings', ['#company', 'tab' => 'logos'])
                ->with('success', 'Struktur organisasi berhasil diupload.');
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
            'logistics_alt' => 'nullable|string|max:255',
            'logistics_name' => 'nullable|string|max:255',
        ]);

        try {
            $image = $request->file('logistics_file');
            $extension = $image->getClientOriginalExtension();
            $logisticsAlt = $request->logistics_alt ?? 'Operasi Logistik ZDX Cargo';
            
            // Generate nama file yang unik
            $fileName = ($request->logistics_name ? Str::slug($request->logistics_name) : 'logistik') . '_' . time() . '.' . $extension;
            
            // Path untuk menyimpan gambar
            $path = $image->storeAs('company_media/logistics', $fileName, 'public');
            
            // Dapatkan setting dari DB atau buat baru jika belum ada
            $setting = DB::table('settings')->first();
            if (!$setting) {
                // Buat data awal jika belum ada
                DB::table('settings')->insert([
                    'key' => 'company_info',
                    'value' => json_encode(['company_name' => 'ZDX Cargo']),
                    'group' => 'company',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                $setting = DB::table('settings')->first();
            }
            
            // Update data di tabel settings
            DB::table('settings')
                ->where('id', $setting->id)
                ->update([
                    "logistics_image_path" => 'storage/' . $path,
                    "logistics_image_name" => $request->logistics_name ?? 'Operasi Logistik',
                    "logistics_image_alt" => $logisticsAlt,
                    "logistics_image_updated_at" => now()
                ]);
            
            // Untuk backward compatibility, simpan juga di lokasi lama
            try {
                $storageFile = Storage::disk('public')->path('company_media/logistics/' . $fileName);
                Storage::disk('public')->put('images/logistics.jpg', file_get_contents($storageFile));
            } catch (\Exception $e) {
                // Gagal duplikasi tidak menghentikan proses
                Log::error('Gagal menyalin gambar logistik ke lokasi lama: ' . $e->getMessage());
            }
            
            // Bersihkan cache
            $this->clearCache();

            return redirect()->route('admin.settings', ['#company', 'tab' => 'logos'])
                ->with('success', 'Gambar logistik berhasil diupload.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengupload gambar logistik: ' . $e->getMessage());
        }
    }
    
    /**
     * Hapus gambar dari database dan storage
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteMedia(Request $request)
    {
        $request->validate([
            'media_type' => 'required|in:logo_1,logo_2,logo_3,title_logo,structure_image,logistics_image',
        ]);

        try {
            $mediaType = $request->media_type;
            
            // Dapatkan setting dari DB
            $setting = DB::table('settings')->first();
            if (!$setting) {
                return redirect()->back()->with('error', 'Pengaturan tidak ditemukan');
            }
            
            // Ambil path gambar
            $pathColumn = "{$mediaType}_path";
            $imagePath = $setting->$pathColumn ?? null;
            
            // Jika ada path gambar
            if ($imagePath) {
                // Hapus file dari storage
                $storagePath = str_replace('storage/', '', $imagePath);
                if (Storage::disk('public')->exists($storagePath)) {
                    Storage::disk('public')->delete($storagePath);
                }
                
                // Update data di tabel settings
                DB::table('settings')
                    ->where('id', $setting->id)
                    ->update([
                        "{$mediaType}_path" => null,
                        "{$mediaType}_name" => null,
                        "{$mediaType}_alt" => null,
                        "{$mediaType}_updated_at" => null
                    ]);
                
                // Bersihkan cache
                $this->clearCache();
                
                return redirect()->route('admin.settings', ['#company', 'tab' => 'logos'])
                    ->with('success', 'Media berhasil dihapus.');
            }
            
            return redirect()->back()->with('error', 'Media tidak ditemukan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus media: ' . $e->getMessage());
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
