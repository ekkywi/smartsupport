<?php

namespace App\Http\Controllers\Asset;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use Illuminate\Http\Request;
use App\Models\AssetCategory;

class AssetCategoryController extends Controller
{
    public function index()
    {
        $assetCategories = AssetCategory::latest()->get();
        return view('contents.asset-category-data', compact('assetCategories'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:asset_categories,name',
                'category_tag' => 'required|unique:asset_categories,category_tag'
            ],
            [
                'name.unique' => 'Kategori aset sudah ada.',
                'name.required' => 'Nama kategori harus diisi.',
                'category_tag.unique' => 'Tag kategori sudah ada.',
                'category_tag.required' => 'Tag kategori harus diisi.'
            ]
        );

        AssetCategory::create([
            'name' => $request->name,
            'category_tag' => $request->category_tag
        ]);

        return response()->json([
            'success' => 'Kategori aset berhasil ditambahkan.'
        ]);
    }

    public function edit(AssetCategory $assetCategory)
    {
        return response()->json($assetCategory);
    }

    public function update(Request $request, AssetCategory $assetCategory)
    {
        $request->validate(
            [
                'name' => 'required|unique:asset_categories,name,' . $assetCategory->id,
                'category_tag' => 'required|unique:asset_categories,category_tag,' . $assetCategory->id
            ],
            [
                'name.unique' => 'Kategori aset sudah ada.',
                'name.required' => 'Nama kategori harus diisi.',
                'category_tag.unique' => 'Tag kategori sudah ada.',
                'category_tag.required' => 'Tag kategori harus diisi.'
            ]
        );

        $assetCategory->update([
            'name' => $request->name,
            'category_tag' => $request->category_tag
        ]);

        return response()->json([
            'success' => 'Kategori aset berhasil diperbarui.'
        ]);
    }

    public function destroy(AssetCategory $assetCategory)
    {
        if ($assetCategory->assetModels()->count() > 0) {
            return response()->json([
                'error' => 'Gagal menghapus! Kategori ini masih digunakan oleh ' . $assetCategory->assetModels()->count() . ' model aset.'
            ], 422);
        }

        $assetCategory->delete();

        return response()->json([
            'success' => 'Kategori aset berhasil dihapus.'
        ]);
    }
}
