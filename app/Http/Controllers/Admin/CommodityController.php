<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commodity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CommodityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commodities = Commodity::all();
        return view('admin.commodity.index', compact('commodities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.commodity.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload image
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'commodity_' . Str::slug($request->name) . '_' . time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('commodities', $filename, 'public');
        }

        Commodity::create([
            'name' => $request->name,
            'description' => $request->description,
            'image_url' => $imagePath,
        ]);

        return redirect()->route('admin.commodity.index')->with('success', 'Komoditas berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Commodity  $commodity
     * @return \Illuminate\Http\Response
     */
    public function edit(Commodity $commodity)
    {
        return view('admin.commodity.edit', compact('commodity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Commodity  $commodity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commodity $commodity)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
        ];

        // Update image if provided
        if ($request->hasFile('image')) {
            // Delete old image
            if ($commodity->image_url && !str_starts_with($commodity->getRawOriginal('image_url'), 'http')) {
                Storage::disk('public')->delete($commodity->getRawOriginal('image_url'));
            }

            // Upload new image
            $image = $request->file('image');
            $filename = 'commodity_' . Str::slug($request->name) . '_' . time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('commodities', $filename, 'public');
            
            $data['image_url'] = $imagePath;
        }

        $commodity->fill($data);
        $commodity->save();

        return redirect()->route('admin.commodity.index')->with('success', 'Komoditas berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commodity  $commodity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commodity $commodity)
    {
        // Delete image if it exists and is not a URL
        if ($commodity->image_url && !str_starts_with($commodity->getRawOriginal('image_url'), 'http')) {
            Storage::disk('public')->delete($commodity->getRawOriginal('image_url'));
        }

        $commodity->delete();

        return redirect()->route('admin.commodity.index')->with('success', 'Komoditas berhasil dihapus');
    }
} 