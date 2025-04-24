<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partners = Partner::orderBy('created_at', 'desc')->get();
        return view('admin.partners.index', compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.partners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'type' => 'required|in:customer,partner',
            'name' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'industry' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:active,inactive',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'website' => 'nullable|url|max:255',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
        ]);
        
        // Menyiapkan data untuk disimpan
        $partnerData = $validated;
        unset($partnerData['logo']); // Hapus logo dari array karena akan disimpan terpisah
        
        // Upload logo jika ada
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('partners/logos', 'public');
            $partnerData['logo_path'] = $logoPath;
        }
        
        // Simpan ke database
        Partner::create($partnerData);
        
        return redirect()->route('admin.partners')->with('success', 'Pelanggan / Partner berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $partner = Partner::findOrFail($id);
            return view('admin.partners.edit', compact('partner'));
        } catch (\Exception $e) {
            // Log error
            \Illuminate\Support\Facades\Log::error('Error editing partner: ' . $e->getMessage());
            // Return with error message
            return redirect()->route('admin.partners')->with('error', 'Terjadi kesalahan saat membuka data partner: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Ambil data partner yang akan diupdate
        $partner = Partner::findOrFail($id);
        
        // Validasi input
        $validated = $request->validate([
            'type' => 'required|in:customer,partner',
            'name' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'industry' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:active,inactive',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'website' => 'nullable|url|max:255',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
        ]);
        
        // Menyiapkan data untuk diupdate
        $partnerData = $validated;
        unset($partnerData['logo']); // Hapus logo dari array karena akan diupdate terpisah
        
        // Upload logo baru jika ada
        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada
            if ($partner->logo_path) {
                Storage::disk('public')->delete($partner->logo_path);
            }
            
            // Upload logo baru
            $logoPath = $request->file('logo')->store('partners/logos', 'public');
            $partnerData['logo_path'] = $logoPath;
        }
        
        // Update data partner
        $partner->update($partnerData);
        
        return redirect()->route('admin.partners')->with('success', 'Pelanggan / Partner berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Ambil data partner yang akan dihapus
            $partner = Partner::findOrFail($id);
            
            // Hapus file logo jika ada
            if ($partner->logo_path) {
                Storage::disk('public')->delete($partner->logo_path);
            }
            
            // Hapus data partner
            $partner->delete();
            
            return redirect()->route('admin.partners')->with('success', 'Pelanggan / Partner berhasil dihapus!');
        } catch (\Exception $e) {
            // Log error
            \Illuminate\Support\Facades\Log::error('Error deleting partner: ' . $e->getMessage());
            
            // Return with error message
            return redirect()->route('admin.partners')->with('error', 'Terjadi kesalahan saat menghapus data partner: ' . $e->getMessage());
        }
    }
}
