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
            'focus_keyword' => 'nullable|string|max:255',
            'toc_mode' => 'nullable|string|in:auto,manual',
            'toc_manual' => 'nullable|string',
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
        
        // Set mode TOC jika tidak diisi
        if (!isset($validated['toc_mode'])) {
            $validated['toc_mode'] = 'auto';
        }
        
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
            $blog->toc_mode = $validated['toc_mode'] ?? 'auto';
            $blog->toc_manual = $validated['toc_manual'] ?? null;
            
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

            return redirect()->route('admin.blogs.index')->with('success', $blog->status == 'published' ? 'Blog berhasil dipublikasikan' : 'Draft blog berhasil disimpan');
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
            'focus_keyword' => 'nullable|string|max:255',
            'toc_mode' => 'nullable|string|in:auto,manual',
            'toc_manual' => 'nullable|string',
        ]);

        try {
            // Simpan slug dan status lama untuk referensi
            $oldSlug = $blog->slug;
            $oldStatus = $blog->status;
            $oldImage = $blog->image;
            
            // Update dasar
            $blog->title = $request->title;
            $blog->slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->title);
            $blog->description = $request->description;
            $blog->content = $request->content;
            $blog->status = $request->has('save_draft') ? 'draft' : $request->status;
            $blog->category = $request->category;
            $blog->tags = $request->tags ? array_map('trim', explode(',', $request->tags)) : null;
            $blog->author = $request->author ?? $blog->author;
            $blog->toc_mode = $request->toc_mode ?? 'auto';
            $blog->toc_manual = $request->toc_manual;
            
            // Set published_at jika status berubah ke published
            if ($oldStatus != 'published' && $blog->status == 'published') {
                $blog->published_at = now();
            }

            // Periksa upload gambar baru terlebih dahulu
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                
                // Validasi tambahan untuk gambar
                if (!$image->isValid()) {
                    throw new \Exception("File gambar tidak valid");
                }
                
                $imageName = time() . '_' . ($request->image_alt ? Str::slug($request->image_alt) : $image->getClientOriginalName());
                
                try {
                    // Hapus gambar lama jika ada
                    if ($oldImage) {
                        try {
                            $oldPath = str_replace('/storage/', '', $oldImage);
                            if (Storage::disk('public')->exists($oldPath)) {
                                Storage::disk('public')->delete($oldPath);
                                Log::info("Gambar lama berhasil dihapus setelah upload gambar baru: $oldPath");
                            }
                        } catch (\Exception $e) {
                            Log::warning("Gagal menghapus gambar lama setelah upload gambar baru: " . $e->getMessage());
                            // Lanjutkan proses meskipun gagal menghapus gambar lama
                        }
                    }

                    // Simpan gambar ke storage publik
                    $path = Storage::disk('public')->putFileAs(
                        'blogs', 
                        $image, 
                        $imageName
                    );
                    
                    // Pastikan file berhasil disimpan
                    if (!Storage::disk('public')->exists($path)) {
                        throw new \Exception("Gagal menyimpan gambar baru");
                    }
                    
                    Log::info("Gambar baru berhasil disimpan: $path");
                    
                    // Perbarui properti gambar
                    $blog->image = Storage::url($path);
                    $blog->image_alt = $request->image_alt;
                    $blog->image_name = $request->image_name;
                    
                } catch (\Exception $e) {
                    Log::error("Gagal memproses gambar baru: " . $e->getMessage());
                    
                    // Gagal upload gambar baru, tetap gunakan gambar lama
                    $blog->image = $oldImage;
                    
                    throw new \Exception("Gagal mengupload gambar: " . $e->getMessage());
                }
            } 
            // Jika tidak ada upload gambar baru, periksa flag delete_image
            else if ($request->has('delete_image') && $request->delete_image == '1') {
                // Hapus gambar lama jika ada
                if ($blog->image) {
                    try {
                        // Ekstrak path relatif dari URL
                        $oldPath = str_replace('/storage/', '', $blog->image);
                        if (Storage::disk('public')->exists($oldPath)) {
                            Storage::disk('public')->delete($oldPath);
                            Log::info("Gambar lama berhasil dihapus: $oldPath");
                        } else {
                            Log::warning("Gambar lama tidak ditemukan: $oldPath");
                        }
                    } catch (\Exception $e) {
                        Log::error("Gagal menghapus gambar lama: " . $e->getMessage());
                        // Lanjutkan proses meskipun gagal menghapus gambar lama
                    }
                }
                
                // Hapus referensi gambar dari database
                $blog->image = null;
                $blog->image_alt = null;
                $blog->image_name = null;
            }
            // Jika tidak ada file yang diupload dan tidak ada perintah hapus gambar, simpan data alt text
            else {
                if ($request->has('image_alt')) {
                    $blog->image_alt = $request->image_alt;
                }
                if ($request->has('image_name')) {
                    $blog->image_name = $request->image_name;
                }
            }

            // Simpan perubahan
            if (!$blog->save()) {
                throw new \Exception("Gagal menyimpan data blog");
            }
            
            Log::info("Blog ID $id berhasil diupdate");

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
            return redirect()->route('admin.blogs.index')->with('success', $message);
        } catch (\Exception $e) {
            Log::error('Error saat mengupdate blog ID ' . $id . ': ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            // Jika terjadi error, tambahkan informasi detail untuk debugging
            $errorMessage = 'Terjadi kesalahan: ' . $e->getMessage();
            
            return redirect()->back()->withInput()->with('error', $errorMessage);
        }
    }

    /**
     * Menghapus blog
     */
    public function destroy($id)
    {
        try {
            $blog = Blog::findOrFail($id);
            $blog->delete(); // Soft delete
            return redirect()->route('admin.blogs.index')->with('success', 'Blog berhasil dipindahkan ke sampah');
        } catch (\Exception $e) {
            Log::error('Error saat menghapus blog: ' . $e->getMessage());
            return redirect()->route('admin.blogs.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Tampilkan daftar blog yang sudah dihapus (sampah)
     */
    public function trash()
    {
        $blogs = Blog::onlyTrashed()->orderBy('deleted_at', 'desc')->paginate(10);
        return view('admin.blogs.trash', compact('blogs'));
    }

    /**
     * Restore blog dari sampah
     */
    public function restore($id)
    {
        $blog = Blog::onlyTrashed()->findOrFail($id);
        $blog->restore();
        return redirect()->route('admin.blogs.trash')->with('success', 'Blog berhasil direstore');
    }
    
    /**
     * Update SEO settings for a blog
     */
    private function updateBlogSeo($blog)
    {
        $identifier = 'blog-' . $blog->slug;
        
        // Mengambil focus keyword dari input form jika tersedia, atau dari kategori/tag
        $focusKeyword = request('focus_keyword');
        if (empty($focusKeyword)) {
            if (!empty($blog->category)) {
                $focusKeyword = $blog->category;
            } elseif (!empty($blog->tags) && is_array($blog->tags) && count($blog->tags) > 0) {
                $focusKeyword = $blog->tags[0];
            }
        }
        
        // Mengambil metadata dasar dari form jika tersedia
        $title = request('seo_title') ? request('seo_title') : $blog->title;
        $description = request('seo_description') ? request('seo_description') : $blog->description;
        $keywords = request('seo_keywords') ? request('seo_keywords') : 'blog ' . $blog->title . ', artikel, zdx cargo' . ($blog->category ? ', ' . $blog->category : '');
        
        try {
            PageSeoSetting::updateOrCreate(
                ['page_identifier' => $identifier],
                [
                    'page_name' => 'Blog: ' . $blog->title,
                    'title' => $title,
                    'description' => $description,
                    'keywords' => $keywords,
                    'og_title' => $blog->title,
                    'og_description' => $blog->description,
                    'og_image' => $blog->image ?? null,
                    'canonical_url' => url($blog->slug),
                    'focus_keyword' => $focusKeyword,
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
        try {
            $blog = Blog::findOrFail($id);
            
            // Hapus gambar jika ada
            if ($blog->image) {
                // Ekstrak path relatif dari URL
                $path = str_replace('/storage/', '', $blog->image);
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                    Log::info("Gambar blog ID $id berhasil dihapus");
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
                
                // Cek apakah permintaan mengharapkan JSON
                if (request()->expectsJson() || request()->ajax()) {
                    return response()->json(['success' => true, 'message' => 'Gambar berhasil dihapus']);
                }
                
                // Untuk permintaan form biasa, redirect kembali ke halaman edit dengan nama route yang benar
                return redirect()->route('admin.blogs.edit', $id)->with('success', 'Gambar berhasil dihapus');
            }
            
            // Jika tidak ada gambar
            if (request()->expectsJson() || request()->ajax()) {
                return response()->json(['success' => false, 'message' => 'Tidak ada gambar untuk dihapus'], 404);
            }
            
            return redirect()->route('admin.blogs.edit', $id)->with('info', 'Tidak ada gambar untuk dihapus');
        } catch (\Exception $e) {
            Log::error('Error saat menghapus gambar blog: ' . $e->getMessage());
            
            if (request()->expectsJson() || request()->ajax()) {
                return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
            }
            
            return redirect()->route('admin.blogs.edit', $id)->with('error', 'Terjadi kesalahan saat menghapus gambar: ' . $e->getMessage());
        }
    }

    /**
     * Upload gambar untuk TinyMCE editor
     */
    public function uploadTinyMCE(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // max 5MB
        ]);

        try {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            
            // Simpan gambar ke storage publik di dalam folder tinymce
            $path = Storage::disk('public')->putFileAs(
                'tinymce', 
                $file, 
                $fileName
            );
            
            // Kembalikan URL gambar yang dapat diakses publik
            $url = Storage::url($path);
            
            return response()->json([
                'location' => $url // Kuncinya harus 'location' untuk TinyMCE
            ]);
        } catch (\Exception $e) {
            Log::error('Error saat upload gambar TinyMCE: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal mengupload gambar'], 500);
        }
    }
}
