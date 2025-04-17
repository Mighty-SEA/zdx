<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
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
        ]);

        $service = new Service();
        $service->title = $request->title;
        $service->slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->title);
        $service->description = $request->description;
        $service->content = $request->content;
        $service->status = $request->status;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            
            // Simpan gambar ke public/uploads/services
            $path = public_path('uploads/services');
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }
            
            $image->move($path, $imageName);
            $service->image = 'uploads/services/' . $imageName;
        }

        $service->save();

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
        ]);

        $service->title = $request->title;
        $service->slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->title);
        $service->description = $request->description;
        $service->content = $request->content;
        $service->status = $request->status;

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($service->image && file_exists(public_path($service->image))) {
                unlink(public_path($service->image));
            }

            // Upload gambar baru
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            
            // Simpan gambar ke public/uploads/services
            $path = public_path('uploads/services');
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }
            
            $image->move($path, $imageName);
            $service->image = 'uploads/services/' . $imageName;
        }

        $service->save();

        return redirect()->route('admin.services')->with('success', 'Layanan berhasil diperbarui');
    }

    /**
     * Menghapus layanan
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        
        // Hapus gambar jika ada
        if ($service->image && file_exists(public_path($service->image))) {
            unlink(public_path($service->image));
        }
        
        $service->delete();

        return redirect()->route('admin.services')->with('success', 'Layanan berhasil dihapus');
    }
} 