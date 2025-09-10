<?php

namespace App\Http\Controllers\AssetNumber;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssetTag;

class AssetTagController extends Controller
{
    public function index()
    {
        $assetTags = AssetTag::all();
        return view('contents.asset-tag', compact('assetTags'));
    }

    public function create()
    {
        return view('forms.asset-tag-form');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string',
                'asset_tag' => 'required|string|unique:asset_tags,asset_tag',
                'description' => 'nullable|string',
            ],
            [
                'name.required' => 'Nama wajib diisi.',
                'asset_tag.required' => 'Tag Aset wajib diisi.',
                'asset_tag.unique' => 'Tag Aset sudah ada dalam sistem.',
                'description.string' => 'Deskripsi harus berupa teks.',
            ]
        );

        AssetTag::create([
            'name' => $request->name,
            'asset_tag' => $request->asset_tag,
            'description' => $request->description,
        ]);

        return redirect()->route('asset.tags.index')->with('success', 'Tag Aset berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $assetTag = AssetTag::findOrFail($id);
        return view('forms.asset-tag-form', compact('assetTag'));
    }

    public function update(Request $request, $id)
    {
        $assetTag = AssetTag::findOrFail($id);

        $request->validate(
            [
                'name' => 'required|string',
                'asset_tag' => 'required|string|unique:asset_tags,asset_tag,' . $assetTag->id,
                'description' => 'nullable|string',
            ],
            [
                'name.required' => 'Nama wajib diisi.',
                'asset_tag.required' => 'Tag Aset wajib diisi.',
                'asset_tag.unique' => 'Tag Aset sudah ada dalam sistem.',
                'description.string' => 'Deskripsi harus berupa teks.',
            ]
        );

        $assetTag->update([
            'name' => $request->name,
            'asset_tag' => $request->asset_tag,
            'description' => $request->description,
        ]);

        return redirect()->route('asset.tags.index')->with('success', 'Tag Aset berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $assetTag = AssetTag::findOrFail($id);
        $assetTag->delete();

        return redirect()->route('asset.tags.index')->with('success', 'Tag Aset berhasil dihapus.');
    }

    public function trashed()
    {
        $trashedAssetTags = AssetTag::onlyTrashed()->get();
        return view('contents.asset-tag-trashed', compact('trashedAssetTags'));
    }

    public function restore($id)
    {
        $assetTag = AssetTag::onlyTrashed()->findOrFail($id);
        $assetTag->restore();

        return redirect()->route('asset.tags.trashed')->with('success', 'Tag Aset berhasil dipulihkan.');
    }

    public function forceDelete($id)
    {
        $assetTag = AssetTag::onlyTrashed()->findOrFail($id);
        $assetTag->forceDelete();

        return redirect()->route('asset.tags.trashed')->with('success', 'Tag Aset berhasil dihapus secara permanen.');
    }
}
