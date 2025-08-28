<?php

namespace App\Http\Controllers\Asset;

use App\Http\Controllers\Controller;
use App\Models\AssetStatus;
use Illuminate\Http\Request;

class AssetStatusController extends Controller
{
    public function index()
    {
        $assetStatuses = AssetStatus::latest()->get();
        return view('contents.asset-status-data', compact('assetStatuses'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:asset_statuses,name'
            ],
            [
                'name.required' => 'Nama status aset harus diisi.',
                'name.unique' => 'Nama status aset sudah terdaftar.'
            ]
        );

        AssetStatus::create([
            'name' => $request->name
        ]);

        return response()->json([
            'success' => 'Status aset berhasil dibuat.'
        ]);
    }

    public function edit(AssetStatus $assetStatus)
    {
        return response()->json($assetStatus);
    }

    public function update(Request $request, AssetStatus $assetStatus)
    {
        $request->validate(
            [
                'name' => 'required|unique:asset_statuses,name,' . $assetStatus->id
            ],
            [
                'name.required' => 'Nama status aset harus diisi.',
                'name.unique' => 'Nama status aset sudah terdaftar.'
            ]
        );

        $assetStatus->update([
            'name' => $request->name
        ]);

        return response()->json([
            'success' => 'Status aset berhasil diperbarui.'
        ]);
    }

    public function destroy(AssetStatus $assetStatus)
    {
        $assetStatus->delete();

        return response()->json([
            'success' => 'Status aset berhasil dihapus.'
        ]);
    }
}
