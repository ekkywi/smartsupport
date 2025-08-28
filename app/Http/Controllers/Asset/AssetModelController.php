<?php

namespace App\Http\Controllers\Asset;

use App\Http\Controllers\Controller;
use App\Models\AssetModel;
use App\Models\AssetBrand;
use App\Models\AssetCategory;
use Illuminate\Http\Request;

class AssetModelController extends Controller
{
    public function index()
    {
        $assetModels = AssetModel::with(['brand', 'category'])->latest()->get();
        return view('contents.asset-model', compact('assetModels'));
    }

    public function create()
    {
        $brands = AssetBrand::orderBy('name')->get();
        $categories = AssetCategory::orderBy('name')->get();
        return view('forms.asset-model-form', compact('brands', 'categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'brand_id' => 'required|uuid|exists:asset_brands,id',
            'category_id' => 'required|uuid|exists:asset_categories,id',
        ]);

        AssetModel::create($validatedData);
        return redirect()->route('assets.model.index')->with('success', 'Model baru berhasil ditambahkan.');
    }

    public function edit(AssetModel $assetModel)
    {
        $brands = AssetBrand::orderBy('name')->get();
        $categories = AssetCategory::orderBy('name')->get();
        return view('forms.asset-model-form', compact('assetModel', 'brands', 'categories'));
    }

    public function update(Request $request, AssetModel $assetModel)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'brand_id' => 'required|uuid|exists:asset_brands,id',
            'category_id' => 'required|uuid|exists:asset_categories,id',
        ]);

        $assetModel->update($validatedData);
        return redirect()->route('assets.model.index')->with('success', 'Model berhasil diperbarui.');
    }

    public function destroy(AssetModel $assetModel)
    {
        $assetModel->delete();
        return redirect()->route('assets.model.index')->with('success', 'Model berhasil dihapus.');
    }
}
