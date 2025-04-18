<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\PageSeoSetting;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ServiceController extends Controller
{
    /**
     * Menampilkan daftar layanan
     */
    public function index()
    {
        $services = Service::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.services.index', compact('services'));
    }

    /**
     * Menampilkan form tambah layanan
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Menyimpan layanan baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'nullable|max:255|unique:services',
            'description' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published',
            'image_alt' => 'nullable|max:255',
            'image_name' => 'nullable|max:255',
        ]);

        $service = new Service();
        $service->title = $request->title;
        $service->slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->title);
        $service->description = $request->description;
        $service->content = $request->content;
        $service->status = $request->status;
        $service->image_alt = $request->image_alt;
        $service->image_name = $request->image_name;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . ($request->image_name ? Str::slug($request->image_name) : $image->getClientOriginalName());
            
            // Simpan gambar ke storage publik
            $path = Storage::disk('public')->putFileAs(
                'services', 
                $image, 
                $imageName
            );
            
            $service->image = Storage::url($path);
        }

        $service->save();

        // Buat atau perbarui pengaturan SEO jika statusnya published
        if ($service->status == 'published') {
            $this->updateServiceSeo($service);
        }

        return redirect()->route('admin.services')->with('success', 'Layanan berhasil ditambahkan');
    }

    /**
     * Menampilkan form edit layanan
     */
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Mengupdate layanan
     */
    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'nullable|max:255|unique:services,slug,' . $id,
            'description' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published',
            'image_alt' => 'nullable|max:255',
            'image_name' => 'nullable|max:255',
        ]);

        // Simpan slug lama untuk referensi
        $oldSlug = $service->slug;
        $oldStatus = $service->status;

        $service->title = $request->title;
        $service->slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->title);
        $service->description = $request->description;
        $service->content = $request->content;
        $service->status = $request->status;
        $service->image_alt = $request->image_alt;
        $service->image_name = $request->image_name;

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($service->image) {
                // Ekstrak path relatif dari URL
                $oldPath = str_replace('/storage/', '', $service->image);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            // Upload gambar baru
            $image = $request->file('image');
            $imageName = time() . '_' . ($request->image_name ? Str::slug($request->image_name) : $image->getClientOriginalName());
            
            // Simpan gambar ke storage publik
            $path = Storage::disk('public')->putFileAs(
                'services', 
                $image, 
                $imageName
            );
            
            $service->image = Storage::url($path);
        }

        $service->save();

        // Jika status berubah dari draft ke published atau slug berubah
        if (($oldStatus != 'published' && $service->status == 'published') || 
            ($oldSlug != $service->slug && $service->status == 'published')) {
            $this->updateServiceSeo($service);
        }
        
        // Jika slug berubah dan status tetap published, hapus seo setting lama
        if ($oldSlug != $service->slug && $oldStatus == 'published' && $service->status == 'published') {
            $oldIdentifier = 'service-' . $oldSlug;
            PageSeoSetting::where('page_identifier', $oldIdentifier)->delete();
        }

        return redirect()->route('admin.services')->with('success', 'Layanan berhasil diperbarui');
    }

    /**
     * Menghapus layanan
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        
        // Hapus gambar jika ada
        if ($service->image) {
            // Ekstrak path relatif dari URL
            $path = str_replace('/storage/', '', $service->image);
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }
        
        // Hapus pengaturan SEO terkait
        $identifier = 'service-' . $service->slug;
        PageSeoSetting::where('page_identifier', $identifier)->delete();
        
        $service->delete();

        return redirect()->route('admin.services')->with('success', 'Layanan berhasil dihapus');
    }
    
    /**
     * Update SEO settings for a service
     */
    private function updateServiceSeo($service)
    {
        $identifier = 'service-' . $service->slug;
        
        PageSeoSetting::updateOrCreate(
            ['page_identifier' => $identifier],
            [
                'page_name' => 'Layanan: ' . $service->title,
                'title' => $service->title . ' - ZDX Cargo',
                'description' => $service->description,
                'keywords' => 'layanan ' . $service->title . ', jasa pengiriman, zdx cargo',
                'og_title' => $service->title,
                'og_description' => $service->description,
                'og_image' => $service->image ?? null,
            ]
        );
    }
} 