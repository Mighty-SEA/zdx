<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rate;
use Illuminate\Support\Facades\Validator;

class RateController extends Controller
{
    public function index()
    {
        $rates = Rate::all();
        return view('admin.rates', compact('rates'));
    }

    public function create()
    {
        return view('admin.rates-create');
    }

    public function store(Request $request)
    {
        if ($request->has('rates')) {
            // Multi-record creation
            $createdCount = 0;
            
            foreach ($request->rates as $rateData) {
                $validator = Validator::make($rateData, [
                    'pulau' => 'required',
                    'provinsi' => 'required',
                    'kota_kab' => 'required',
                    'kelurahan_kecamatan' => 'required',
                    'harga_satuan' => 'required|numeric',
                    'minimal_kg' => 'required|numeric',
                    'estimasi' => 'required'
                ]);

                if (!$validator->fails()) {
                    Rate::create($rateData);
                    $createdCount++;
                }
            }
            
            return redirect()->route('admin.rates')->with('success', $createdCount . ' data tarif berhasil ditambahkan');
        } else {
            // Single record creation (for API)
            $validator = Validator::make($request->all(), [
                'pulau' => 'required',
                'provinsi' => 'required',
                'kota_kab' => 'required',
                'kelurahan_kecamatan' => 'required',
                'harga_satuan' => 'required|numeric',
                'minimal_kg' => 'required|numeric',
                'estimasi' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }

            $rate = Rate::create($request->all());
            
            if ($request->wantsJson()) {
                return response()->json(['success' => 'Data berhasil ditambahkan']);
            }
            
            return redirect()->route('admin.rates')->with('success', 'Data tarif berhasil ditambahkan');
        }
    }

    public function edit($id)
    {
        $rate = Rate::findOrFail($id);
        return view('admin.rates-edit', compact('rate'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'pulau' => 'required',
            'provinsi' => 'required',
            'kota_kab' => 'required',
            'kelurahan_kecamatan' => 'required',
            'harga_satuan' => 'required|numeric',
            'minimal_kg' => 'required|numeric',
            'estimasi' => 'required'
        ]);

        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json(['errors' => $validator->errors()]);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $rate = Rate::find($id);
        $rate->update($request->all());

        if ($request->wantsJson()) {
            return response()->json(['success' => 'Data berhasil diperbarui']);
        }
        
        return redirect()->route('admin.rates')->with('success', 'Data tarif berhasil diperbarui');
    }

    public function destroy($id)
    {
        $rate = Rate::findOrFail($id);
        $rate->delete();

        if (request()->wantsJson()) {
            return response()->json(['success' => 'Data berhasil dihapus']);
        }
        
        return redirect()->route('admin.rates')->with('success', 'Data tarif berhasil dihapus');
    }
} 