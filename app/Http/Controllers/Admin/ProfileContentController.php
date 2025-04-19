<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProfileContent;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ProfileContentController extends Controller
{
    /**
     * Display a listing of the profile contents.
     */
    public function index()
    {
        $contents = ProfileContent::orderBy('order')->get();
        return view('admin.profile_content.index', compact('contents'));
    }

    /**
     * Show the form for editing the specified profile content.
     */
    public function edit($id)
    {
        $content = ProfileContent::findOrFail($id);
        return view('admin.profile_content.edit', compact('content'));
    }

    /**
     * Update the specified profile content in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'is_active' => 'nullable',
            'company_name' => 'nullable|string|max:255',
            'company_slogan' => 'nullable|string|max:255',
            'company_description' => 'nullable|string',
            'org_structure_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'contact_phone' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_address' => 'nullable|string',
            'contact_maps_link' => 'nullable|url|max:1000',
            'contact_facebook' => 'nullable|url|max:255',
            'contact_instagram' => 'nullable|url|max:255',
            'contact_twitter' => 'nullable|url|max:255',
            'contact_youtube' => 'nullable|url|max:255',
        ]);
        
        // Log data mentah yang diterima
        Log::info('ProfileContent Update Raw Request:', [
            'id' => $id,
            'all_input' => $request->all(),
            'has_content' => $request->has('content'),
            'content_empty' => empty($request->content),
            'content_length' => $request->has('content') ? strlen($request->content) : 0,
        ]);

        try {
            // Cari konten profil yang akan diupdate
            $profileContent = ProfileContent::findOrFail($id);
            
            // Log konten sebelum diubah
            Log::info('ProfileContent Before Update:', [
                'id' => $profileContent->id,
                'title' => $profileContent->title,
                'content' => $profileContent->content,
                'is_active' => $profileContent->is_active,
            ]);
            
            // Persiapkan data yang akan diupdate
            $dataToUpdate = [
                'title' => $request->title,
                'content' => $request->content,
                'is_active' => $request->has('is_active') ? true : false,
            ];
            
            // Upload gambar struktur organisasi jika ada
            if ($request->hasFile('org_structure_image')) {
                $image = $request->file('org_structure_image');
                $fileName = 'org_structure_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/images'), $fileName);
                
                // Simpan path gambar relatif ke storage
                $dataToUpdate['org_structure_path'] = 'uploads/images/' . $fileName;
                
                // Log info upload gambar
                Log::info('Uploaded org structure image:', [
                    'original_name' => $image->getClientOriginalName(),
                    'stored_as' => $fileName,
                    'path' => $dataToUpdate['org_structure_path']
                ]);
            }
            
            // Tambahkan field baru jika ini adalah bagian 'about'
            if ($profileContent->section == 'about') {
                $dataToUpdate['company_name'] = $request->company_name;
                $dataToUpdate['company_slogan'] = $request->company_slogan;
                $dataToUpdate['company_description'] = $request->company_description;
                $dataToUpdate['contact_phone'] = $request->contact_phone;
                $dataToUpdate['contact_email'] = $request->contact_email;
                $dataToUpdate['contact_address'] = $request->contact_address;
                $dataToUpdate['contact_maps_link'] = $request->contact_maps_link;
                $dataToUpdate['contact_facebook'] = $request->contact_facebook;
                $dataToUpdate['contact_instagram'] = $request->contact_instagram;
                $dataToUpdate['contact_twitter'] = $request->contact_twitter;
                $dataToUpdate['contact_youtube'] = $request->contact_youtube;
            }
            
            // Log data yang akan diupdate
            Log::info('ProfileContent Data To Update:', $dataToUpdate);
            
            // Lakukan update
            $updated = $profileContent->update($dataToUpdate);
            
            // Log hasil update
            Log::info('ProfileContent Update Result:', [
                'success' => $updated,
                'after_update' => [
                    'id' => $profileContent->id,
                    'title' => $profileContent->title, 
                    'content' => $profileContent->content,
                    'is_active' => $profileContent->is_active,
                ]
            ]);

            // Hapus cache
            Cache::flush();

            // Redirect ke index dengan pesan sukses
            return redirect()->route('admin.profile-content.index')
                ->with('success', 'Konten profil berhasil diperbarui.');
        } catch (\Exception $e) {
            // Log error
            Log::error('Error updating profile content:', [
                'id' => $id,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            
            // Redirect kembali dengan pesan error
            return redirect()->back()
                ->with('error', 'Gagal menyimpan perubahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Update the order of profile contents.
     */
    public function updateOrder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer',
        ]);

        try {
            foreach ($request->order as $id => $order) {
                ProfileContent::where('id', $id)->update(['order' => $order]);
            }

            // Pastikan cache dihapus untuk memastikan perubahan terlihat
            if (Cache::has('profile_contents')) {
                Cache::forget('profile_contents');
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Error updating profile content order: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
} 