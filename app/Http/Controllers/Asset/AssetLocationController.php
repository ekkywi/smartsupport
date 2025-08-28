<?php

namespace App\Http\Controllers\Asset;

use App\Http\Controllers\Controller;
use App\Models\AssetLocation;
use Illuminate\Http\Request;

class AssetLocationController extends Controller
{
    public function index()
    {
        $assetLocations = AssetLocation::latest()->get();
        return view('contents.asset-location-data', compact('assetLocations'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:asset_locations,name'
            ],
            [
                'name.required' => 'Nama lokasi aset harus diisi.',
                'name.unique' => 'Nama lokasi aset sudah terdaftar.'
            ]
        );

        AssetLocation::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return response()->json([
            'message' => 'Lokasi aset berhasil ditambahkan.'
        ]);
    }

    public function edit(AssetLocation $assetLocation)
    {
        return response()->json($assetLocation);
    }

    public function update(Request $request, AssetLocation $assetLocation)
    {
        $request->validate(
            [
                'name' => 'required|unique:asset_locations,name,' . $assetLocation->id
            ],
            [
                'name.required' => 'Nama lokasi aset harus diisi.',
                'name.unique' => 'Nama lokasi aset sudah terdaftar.'
            ]
        );

        $assetLocation->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return response()->json([
            'message' => 'Lokasi aset berhasil diperbarui.'
        ]);
    }

    public function destroy(AssetLocation $assetLocation)
    {
        $assetLocation->delete();

        return response()->json([
            'success' => 'Lokasi aset berhasil dihapus.'
        ]);
    }
}
