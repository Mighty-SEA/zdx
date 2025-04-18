<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class HomeContentController extends Controller
{
    /**
     * Display a listing of the home content sections.
     */
    public function index()
    {
        // Dapatkan semua bagian konten berdasarkan urutan, kecuali partner
        $contentSections = HomeContent::where('section_key', '!=', 'partners')
                          ->orderBy('order', 'asc')
                          ->get();
        
        return view('admin.home_content.index', compact('contentSections'));
    }

    /**
     * Show the form for editing the specified section.
     */
    public function edit($id)
    {
        $section = HomeContent::findOrFail($id);
        
        return view('admin.home_content.edit', compact('section'));
    }

    /**
     * Update the specified section in storage.
     */
    public function update(Request $request, $id)
    {
        $section = HomeContent::findOrFail($id);
        
        // Log request data untuk debugging
        Log::info('HomeContent update request', [
            'section_id' => $id,
            'section_key' => $section->section_key,
            'request_data' => $request->all(),
            'has_file' => $request->hasFile('image'),
            'file_valid' => $request->hasFile('image') ? $request->file('image')->isValid() : false,
            'no_image_flag' => $request->has('no_image'),
            'storage_path' => Storage::disk('public')->path('')
        ]);
        
        // Validasi umum untuk semua jenis bagian
        $rules = [
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|string|max:255',
            'image' => 'nullable',
        ];
        
        // Tambahkan validasi image hanya jika ada file yang diupload
        if ($request->hasFile('image') && $request->file('image')->isValid() && !empty($request->file('image')->getClientOriginalName())) {
            $rules['image'] = 'image|mimes:jpeg,png,jpg,gif|max:2048';
        }
        
        // Validasi khusus berdasarkan jenis bagian
        switch ($section->section_key) {
            case 'hero':
                $rules['button2_text'] = 'nullable|string|max:255';
                $rules['button2_url'] = 'nullable|string|max:255';
                break;
                
            case 'stats':
                $rules['stats'] = 'required|array';
                $rules['stats.*.number'] = 'required|string';
                $rules['stats.*.label'] = 'required|string';
                $rules['stats.*.symbol'] = 'nullable|string';
                break;
                
            case 'features':
                $rules['content'] = 'nullable|string';
                $rules['on_time_text'] = 'nullable|string|max:255';
                $rules['on_time_percentage'] = 'nullable|string|max:255';
                break;
                
            case 'service_cards':
                // Validasi untuk CTA section
                $rules['point1'] = 'nullable|string|max:255';
                $rules['point2'] = 'nullable|string|max:255';
                $rules['point3'] = 'nullable|string|max:255';
                $rules['secondary_button_text'] = 'nullable|string|max:255';
                $rules['secondary_button_url'] = 'nullable|string|max:255';
                $rules['quote_text'] = 'nullable|string';
                break;
        }
        
        $validated = $request->validate($rules);
        
        // Update data bagian
        $section->is_active = $request->has('is_active');
        
        // Update field umum
        foreach (['title', 'subtitle', 'button_text', 'button_url'] as $field) {
            if (isset($validated[$field])) {
                $section->$field = $validated[$field];
            }
        }
        
        // Update konten rich editor jika ada
        if (isset($validated['content']) && $section->use_rich_editor) {
            $section->content = $validated['content'];
        }
        
        // Update field content khusus untuk CTA section
        if ($section->section_key === 'service_cards' && isset($validated['point1'])) {
            $section->content = $validated['point1'];
        }
        
        // Update metadata berdasarkan jenis bagian
        $metadata = json_decode($section->metadata ?? '{}', true) ?: [];
        
        switch ($section->section_key) {
            case 'hero':
                if (isset($validated['button2_text'])) {
                    $metadata['button2_text'] = $validated['button2_text'];
                }
                if (isset($validated['button2_url'])) {
                    $metadata['button2_url'] = $validated['button2_url'];
                }
                break;
                
            case 'stats':
                if (isset($validated['stats'])) {
                    $metadata['items'] = $validated['stats'];
                }
                break;
                
            case 'features':
                if (isset($validated['on_time_text'])) {
                    $metadata['on_time_text'] = $validated['on_time_text'];
                }
                if (isset($validated['on_time_percentage'])) {
                    $metadata['on_time_percentage'] = $validated['on_time_percentage'];
                }
                break;
                
            case 'service_cards':
                // Update metadata untuk CTA section
                if (isset($validated['point1'])) {
                    $metadata['point1'] = $validated['point1'];
                }
                if (isset($validated['point2'])) {
                    $metadata['point2'] = $validated['point2'];
                }
                if (isset($validated['point3'])) {
                    $metadata['point3'] = $validated['point3'];
                }
                if (isset($validated['secondary_button_text'])) {
                    $metadata['secondary_button_text'] = $validated['secondary_button_text'];
                }
                if (isset($validated['secondary_button_url'])) {
                    $metadata['secondary_button_url'] = $validated['secondary_button_url'];
                }
                if (isset($validated['quote_text'])) {
                    $metadata['quote_text'] = $validated['quote_text'];
                }
                break;
        }
        
        $section->metadata = json_encode($metadata);
        
        // Handle image upload jika ada
        if ($request->hasFile('image') && $request->file('image')->isValid() && !empty($request->file('image')->getClientOriginalName())) {
            try {
                $image = $request->file('image');
                
                // Log info tentang file yang diupload
                Log::info('Upload image attempt', [
                    'original_name' => $image->getClientOriginalName(),
                    'mime_type' => $image->getMimeType(),
                    'size' => $image->getSize(),
                    'error' => $image->getError()
                ]);
                
                // Buat direktori jika belum ada
                $uploadPath = 'home_content';
                if (!Storage::disk('public')->exists($uploadPath)) {
                    Storage::disk('public')->makeDirectory($uploadPath);
                }
                
                // Hapus gambar lama jika ada
                if (!empty($section->image_path) && Storage::disk('public')->exists($section->image_path)) {
                    Storage::disk('public')->delete($section->image_path);
                }
                
                // Generate nama file yang unik
                $fileName = 'home_content_' . Str::slug($section->section_key) . '_' . time();
                
                // Pastikan ekstensi file ada
                $extension = $image->getClientOriginalExtension();
                if (empty($extension)) {
                    $extension = $image->guessExtension();
                    if (empty($extension)) {
                        $extension = 'jpg'; // Default jika tidak bisa mendeteksi
                    }
                }
                
                $fileName .= '.' . $extension;
                
                // Upload file menggunakan move langsung
                $image->move(storage_path('app/public/' . $uploadPath), $fileName);
                $section->image_path = $uploadPath . '/' . $fileName;
                
                Log::info('HomeContent image moved manually', [
                    'section_id' => $section->id,
                    'file_name' => $fileName,
                    'path' => $section->image_path,
                    'source_path' => $image->getPathname(),
                    'destination' => storage_path('app/public/' . $uploadPath . '/' . $fileName)
                ]);
            } catch (\Exception $e) {
                Log::error('Failed to upload image for HomeContent', [
                    'id' => $section->id,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                
                return redirect()->back()
                    ->with('error', 'Gagal mengupload gambar: ' . $e->getMessage())
                    ->withInput();
            }
        } else if ($request->hasFile('image')) {
            Log::warning('Invalid image upload attempt', [
                'has_file' => $request->hasFile('image'),
                'is_valid' => $request->hasFile('image') ? $request->file('image')->isValid() : false,
                'original_name' => $request->hasFile('image') ? $request->file('image')->getClientOriginalName() : 'none',
                'size' => $request->hasFile('image') ? $request->file('image')->getSize() : 0,
                'error' => $request->hasFile('image') ? $request->file('image')->getError() : 'no file'
            ]);
        }
        
        // Simpan perubahan dengan error logging
        try {
            $saved = $section->save();
            
            // Log untuk debugging
            Log::info('HomeContent updated', [
                'id' => $section->id,
                'section_key' => $section->section_key,
                'title' => $section->title,
                'is_active' => $section->is_active,
                'saved' => $saved,
                'updated_data' => $section->toArray()
            ]);
            
            return redirect()->route('admin.home-content.index')
                ->with('success', 'Bagian ' . $section->section_name . ' berhasil diperbarui');
        } catch (\Exception $e) {
            Log::error('Failed to update HomeContent', [
                'id' => $section->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()
                ->with('error', 'Gagal memperbarui bagian: ' . $e->getMessage())
                ->withInput();
        }
    }
    
    /**
     * Update the order of sections.
     */
    public function updateOrder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer|exists:home_contents,id',
        ]);
        
        $order = $request->input('order');
        
        foreach ($order as $position => $sectionId) {
            HomeContent::where('id', $sectionId)->update(['order' => $position + 1]);
        }
        
        return response()->json(['success' => true]);
    }
} 