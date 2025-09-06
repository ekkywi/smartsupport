<?php

namespace App\Http\Controllers\AssetStatus;

use App\Http\Controllers\Controller;
use App\Models\AssetStatus;
use Illuminate\Http\Request;

class AssetStatusController extends Controller
{
    public function index()
    {
        $assetStatuses = AssetStatus::all();
        return view('contents.asset-status', compact('assetStatuses'));
    }

    public function create()
    {
        return view('forms.asset-status-form');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|unique:asset_statuses,name',
                'asset_status_tag' => 'required|string|unique:asset_statuses,asset_status_tag',
                'description' => 'nullable|string',
            ],
            [
                'name.required' => 'Nama status aset wajib diisi.',
                'name.unique' => 'Nama status aset sudah ada, atau pulihkan status aset yang terhapus.',
                'asset_status_tag.required' => 'Tag status aset wajib diisi.',
                'asset_status_tag.unique' => 'Tag status aset sudah ada, atau pulihkan status aset yang terhapus.',
            ]
        );

        AssetStatus::create([
            'name' => $request->name,
            'asset_status_tag' => $request->asset_status_tag,
            'description' => $request->description,
        ]);

        return redirect()->route('asset-status.index')->with('success', 'Status aset berhasil ditambahkan.');
    }

    public function edit(AssetStatus $assetStatus)
    {
        return view('forms.asset-status-form', compact('assetStatus'));
    }

    public function update(Request $request, AssetStatus $assetStatus)
    {
        $request->validate(
            [
                'name' => 'required|string|unique:asset_statuses,name,' . $assetStatus->id,
                'asset_status_tag' => 'required|string|unique:asset_statuses,asset_status_tag,' . $assetStatus->id,
                'description' => 'nullable|string',
            ],
            [
                'name.required' => 'Nama status aset wajib diisi.',
                'name.unique' => 'Nama status aset sudah ada, atau pulihkan status aset yang terhapus.',
                'asset_status_tag.required' => 'Tag status aset wajib diisi.',
                'asset_status_tag.unique' => 'Tag status aset sudah ada, atau pulihkan status aset yang terhapus.',
            ]
        );

        $assetStatus->update([
            'name' => $request->name,
            'asset_status_tag' => $request->asset_status_tag,
            'description' => $request->description,
        ]);

        return redirect()->route('asset-status.index')->with('success', 'Status aset berhasil diperbarui.');
    }

    public function destroy(AssetStatus $assetStatus)
    {
        $assetStatus->delete();
        return redirect()->route('asset-status.index')->with('success', 'Status aset berhasil dihapus.');
    }

    public function trashed()
    {
        $trashedAssetStatuses = AssetStatus::onlyTrashed()->get();
        return view('contents.asset-status-trashed', compact('trashedAssetStatuses'));
    }

    public function restore($id)
    {
        $assetStatus = AssetStatus::onlyTrashed()->findOrFail($id);
        $assetStatus->restore();
        return redirect()->route('asset-status.trashed')->with('success', 'Status aset berhasil dipulihkan.');
    }

    public function forceDelete($id)
    {
        $assetStatus = AssetStatus::onlyTrashed()->findOrFail($id);
        $assetStatus->forceDelete();
        return redirect()->route('asset-status.trashed')->with('success', 'Status aset berhasil dihapus secara permanen.');
    }
}
