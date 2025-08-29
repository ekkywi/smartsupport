<?php

namespace App\Http\Controllers\Asset;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssetBrand;

class AssetBrandController extends Controller
{
    public function index()
    {
        $assetBrands = AssetBrand::latest()->get();
        return view("contents.asset-brand-data", compact("assetBrands"));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:asset_brands,name',
            ],
            [
                'name.required' => 'Nama merek harus diisi.',
                'name.unique' => 'Nama merek sudah ada.'
            ]
        );

        AssetBrand::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'success' => 'Merek aset berhasil ditambahkan.'
        ]);
    }

    public function edit(AssetBrand $assetBrand)
    {
        return response()->json($assetBrand);
    }

    public function update(Request $request, AssetBrand $assetBrand)
    {
        $request->validate(
            [
                'name' => 'required|unique:asset_brands,name,' . $assetBrand->id,
            ],
            [
                'name.required' => 'Nama merek harus diisi.',
                'name.unique' => 'Nama merek sudah ada.'
            ]
        );

        $assetBrand->update([
            'name' => $request->name,
        ]);

        return response()->json([
            'success' => 'Merek aset berhasil diperbarui.'
        ]);
    }

    public function destroy(AssetBrand $assetBrand)
    {
        if ($assetBrand->assetModels()->count() > 0) {
            return response()->json([
                'error' => 'Gagal menghapus! Merk ini masih digunakan oleh ' . $assetBrand->assetModels()->count() . ' model aset.'
            ], 422);
        }

        $assetBrand->delete();

        return response()->json([
            'success' => 'Merek aset berhasil dihapus.'
        ]);
    }
}
