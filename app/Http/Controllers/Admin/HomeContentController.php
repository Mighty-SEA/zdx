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
        // Dapatkan semua bagian konten berdasarkan urutan
        $contentSections = HomeContent::orderBy('order', 'asc')->get();
        
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
            'request_data' => $request->all()
        ]);
        
        // Validasi umum untuk semua jenis bagian
        $rules = [
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
        
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
                
            case 'cta':
                $rules['benefits'] = 'nullable|array';
                $rules['benefits.*'] = 'required|string';
                $rules['button2_text'] = 'nullable|string|max:255';
                $rules['button2_url'] = 'nullable|string|max:255';
                break;
                
            case 'service_cards':
                $rules['content'] = 'nullable|string';
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
                
            case 'cta':
                if (isset($validated['benefits'])) {
                    $metadata['benefits'] = $validated['benefits'];
                }
                if (isset($validated['button2_text'])) {
                    $metadata['button2_text'] = $validated['button2_text'];
                }
                if (isset($validated['button2_url'])) {
                    $metadata['button2_url'] = $validated['button2_url'];
                }
                break;
        }
        
        $section->metadata = json_encode($metadata);
        
        // Handle image upload jika ada
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            
            // Hapus gambar lama jika ada
            if ($section->image_path) {
                Storage::disk('public')->delete($section->image_path);
            }
            
            // Simpan gambar baru
            $path = $image->store('home_content', 'public');
            $section->image_path = $path;
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