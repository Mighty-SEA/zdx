<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\PageSeoSetting;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Menampilkan daftar blog
     */
    public function index()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Menampilkan form tambah blog
     */
    public function create()
    {
        return view('admin.blogs.create');
    }

    /**
     * Menyimpan blog baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blogs',
            'description' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_alt' => 'nullable|string|max:255',
            'author' => 'nullable|string|max:100',
            'category' => 'nullable|string|max:100',
            'tags' => 'nullable|string',
            'status' => 'required|in:draft,published',
        ]);
        
        // Periksa jika tombol "Simpan Draft" ditekan
        if ($request->has('save_draft')) {
            $validated['status'] = 'draft';
        }
        
        // Jika slug kosong, buat dari judul
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }
        
        // Proses tag dari string menjadi array
        $tags = [];
        if (!empty($validated['tags'])) {
            $tags = array_map('trim', explode(',', $validated['tags']));
        }
        $validated['tags'] = $tags;
        
        // Set tanggal publikasi jika status published
        if ($validated['status'] === 'published' && !isset($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        try {
            $blog = new Blog();
            $blog->title = $validated['title'];
            $blog->slug = $validated['slug'];
            $blog->description = $validated['description'];
            $blog->content = $validated['content'];
            $blog->status = $validated['status'];
            $blog->image_alt = $validated['image_alt'];
            $blog->image_name = $request->image_name;
            $blog->category = $validated['category'];
            $blog->tags = $validated['tags'];
            $blog->author = $validated['author'] ?? (Auth::check() ? Auth::user()->name : 'Admin');
            
            if ($blog->status == 'published') {
                $blog->published_at = $validated['published_at'] ?? now();
            }

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . ($validated['image_alt'] ? Str::slug($validated['image_alt']) : $image->getClientOriginalName());
                
                // Simpan gambar ke storage publik
                $path = Storage::disk('public')->putFileAs(
                    'blogs', 
                    $image, 
                    $imageName
                );
                
                $blog->image = Storage::url($path);
            }

            $blog->save();

            // Buat atau perbarui pengaturan SEO jika statusnya published
            if ($blog->status == 'published') {
                $this->updateBlogSeo($blog);
            }

            return redirect()->route('admin.blogs')->with('success', $blog->status == 'published' ? 'Blog berhasil dipublikasikan' : 'Draft blog berhasil disimpan');
        } catch (\Exception $e) {
            Log::error('Error saat menyimpan blog: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan form edit blog
     */
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blogs.edit', compact('blog'));
    }

    /**
     * Mengupdate blog
     */
    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'nullable|max:255|unique:blogs,slug,' . $id,
            'description' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published',
            'image_alt' => 'nullable|max:255',
            'image_name' => 'nullable|max:255',
            'category' => 'nullable|max:255',
            'tags' => 'nullable',
            'author' => 'nullable|max:255',
        ]);

        try {
            // Simpan slug dan status lama untuk referensi
            $oldSlug = $blog->slug;
            $oldStatus = $blog->status;

            $blog->title = $request->title;
            $blog->slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->title);
            $blog->description = $request->description;
            $blog->content = $request->content;
            $blog->status = $request->has('save_draft') ? 'draft' : $request->status;
            $blog->image_alt = $request->image_alt;
            $blog->image_name = $request->image_name;
            $blog->category = $request->category;
            $blog->tags = $request->tags ? array_map('trim', explode(',', $request->tags)) : null;
            $blog->author = $request->author ?? $blog->author;
            
            // Set published_at jika status berubah ke published
            if ($oldStatus != 'published' && $blog->status == 'published') {
                $blog->published_at = now();
            }

            // Cek apakah penghapusan gambar diminta
            if ($request->has('delete_image') && $request->delete_image == '1') {
                // Hapus gambar lama jika ada
                if ($blog->image) {
                    // Ekstrak path relatif dari URL
                    $oldPath = str_replace('/storage/', '', $blog->image);
                    if (Storage::disk('public')->exists($oldPath)) {
                        Storage::disk('public')->delete($oldPath);
                    }
                }
                
                // Hapus referensi gambar dari database
                $blog->image = null;
                $blog->image_alt = null;
                $blog->image_name = null;
            }
            else if ($request->hasFile('image')) {
                // Hapus gambar lama jika ada
                if ($blog->image) {
                    // Ekstrak path relatif dari URL
                    $oldPath = str_replace('/storage/', '', $blog->image);
                    if (Storage::disk('public')->exists($oldPath)) {
                        Storage::disk('public')->delete($oldPath);
                    }
                }

                // Upload gambar baru
                $image = $request->file('image');
                $imageName = time() . '_' . ($request->image_alt ? Str::slug($request->image_alt) : $image->getClientOriginalName());
                
                // Simpan gambar ke storage publik
                $path = Storage::disk('public')->putFileAs(
                    'blogs', 
                    $image, 
                    $imageName
                );
                
                $blog->image = Storage::url($path);
            }

            $blog->save();

            // Jika status berubah dari draft ke published atau slug berubah
            if (($oldStatus != 'published' && $blog->status == 'published') || 
                ($oldSlug != $blog->slug && $blog->status == 'published')) {
                $this->updateBlogSeo($blog);
            }
            
            // Jika slug berubah dan status tetap published, hapus seo setting lama
            if ($oldSlug != $blog->slug && $oldStatus == 'published' && $blog->status == 'published') {
                $oldIdentifier = 'blog-' . $oldSlug;
                PageSeoSetting::where('page_identifier', $oldIdentifier)->delete();
            }

            $message = $blog->status == 'published' ? 'Blog berhasil diperbarui dan dipublikasikan' : 'Draft blog berhasil disimpan';
            return redirect()->route('admin.blogs')->with('success', $message);
        } catch (\Exception $e) {
            Log::error('Error saat mengupdate blog: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Menghapus blog
     */
    public function destroy($id)
    {
        try {
            $blog = Blog::findOrFail($id);
            
            // Hapus gambar jika ada
            if ($blog->image) {
                // Ekstrak path relatif dari URL
                $path = str_replace('/storage/', '', $blog->image);
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }
            
            // Hapus pengaturan SEO terkait
            $identifier = 'blog-' . $blog->slug;
            PageSeoSetting::where('page_identifier', $identifier)->delete();
            
            $blog->delete();

            return redirect()->route('admin.blogs')->with('success', 'Blog berhasil dihapus');
        } catch (\Exception $e) {
            Log::error('Error saat menghapus blog: ' . $e->getMessage());
            return redirect()->route('admin.blogs')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    /**
     * Update SEO settings for a blog
     */
    private function updateBlogSeo($blog)
    {
        $identifier = 'blog-' . $blog->slug;
        
        try {
            PageSeoSetting::updateOrCreate(
                ['page_identifier' => $identifier],
                [
                    'page_name' => 'Blog: ' . $blog->title,
                    'title' => $blog->title . ' - ZDX Cargo',
                    'description' => $blog->description,
                    'keywords' => 'blog ' . $blog->title . ', artikel, zdx cargo' . ($blog->category ? ', ' . $blog->category : ''),
                    'og_title' => $blog->title,
                    'og_description' => $blog->description,
                    'og_image' => $blog->image ?? null,
                    'canonical_url' => url($blog->slug),
                ]
            );
        } catch (\Exception $e) {
            Log::error('Error saat mengupdate SEO blog: ' . $e->getMessage());
        }
    }

    /**
     * Menghapus hanya gambar dari blog
     */
    public function deleteImage($id)
    {
        $blog = Blog::findOrFail($id);
        
        // Hapus gambar jika ada
        if ($blog->image) {
            // Ekstrak path relatif dari URL
            $path = str_replace('/storage/', '', $blog->image);
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
            
            // Hapus referensi gambar dari database
            $blog->image = null;
            $blog->image_alt = null;
            $blog->image_name = null;
            $blog->save();
            
            // Perbarui SEO jika perlu
            if ($blog->status == 'published') {
                $this->updateBlogSeo($blog);
            }
            
            return response()->json(['success' => true, 'message' => 'Gambar berhasil dihapus']);
        }
        
        return response()->json(['success' => false, 'message' => 'Tidak ada gambar untuk dihapus'], 404);
    }
}
