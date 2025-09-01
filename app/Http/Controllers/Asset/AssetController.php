<?php

namespace App\Http\Controllers\Asset;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Asset;
use App\Models\AssetStatus;
use App\Models\AssetLocation;
use App\Models\User;
use App\Models\AssetModel;
use App\Models\DigitalService;
use App\Models\HardwareDetail;
use App\Models\SoftwareDetail;

class AssetController extends Controller
{
    public function index()
    {
        $assets = Asset::with([
            'status',
            'user',
            'location',
            'assetable.model.brand',
            'assetable.model.category'
        ])->latest()->get();

        return view('contents.asset', compact('assets'));
    }

    public function create()
    {
        $statuses = AssetStatus::orderBy('name')->get();
        $locations = AssetLocation::orderBy('name')->get();
        $users = User::orderBy('name')->get();
        $models = AssetModel::orderBy('name')->get();

        return view('forms.asset-form', compact('statuses', 'locations', 'users', 'models'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'asset_type' => 'required|in:hardware,software,digital_service',
                'status_id' => 'nullable|uuid|exists:asset_statuses,id',
                'location_id' => 'nullable|uuid|exists:asset_locations,id',
                'assigned_to_user_id' => 'nullable|uuid|exists:users,id',
                'notes' => 'nullable|string'
            ],
            [
                'name' => 'required|string|max:255',
                'asset_type' => 'required|in:hardware,software,digital_service',
                'status_id' => 'nullable|uuid|exists:asset_statuses,id',
                'location_id' => 'nullable|uuid|exists:asset_locations,id',
                'user_id' => 'nullable|uuid|exists:users,id',
                'notes' => 'nullable|string'
            ]
        );

        if ($request->asset_type === 'hardware') {
            $request->validate(
                [
                    'asset_tag' => 'required|string|max:255|unique:hardware_details,asset_tag',
                    'serial_number' => 'nullable|string|max:255',
                    'model_id' => 'nullable|uuid|exists:asset_models,id',
                    'warranty_expires_at' => 'nullable|date'
                ],
                [
                    'asset_tag.required' => 'Tag aset harus diisi.',
                    'asset_tag.unique' => 'Tag aset sudah terdaftar.',
                    'model_id.exists' => 'Model yang dipilih tidak valid.',
                    'warranty_expires_at.date' => 'Tanggal kadaluarsa garansi tidak valid.',
                ]
            );

            $hardwareDetail = HardwareDetail::create([
                'asset_tag' => $request->asset_tag,
                'serial_number' => $request->serial_number,
                'model_id' => $request->model_id,
                'warranty_expires_at' => $request->warranty_expires_at,
            ]);
            $assetableType = HardwareDetail::class;
            $assetableId = $hardwareDetail->id;
        } elseif ($request->asset_type === 'software') {
            $softwareLicense = SoftwareDetail::create([
                'license_key' => $request->license_key,
                'total_seats' => $request->total_seats,
            ]);
            $assetableType = SoftwareDetail::class;
            $assetableId = $softwareLicense->id;
        } else {
            $digitalService = DigitalService::create([
                'provider' => $request->provider,
                'service_name' => $request->service_name,
            ]);
            $assetableType = DigitalService::class;
            $assetableId = $digitalService->id;
        }

        Asset::create([
            'name' => $request->name,
            'assetable_type' => $assetableType,
            'assetable_id' => $assetableId,
            'status_id' => $request->status_id,
            'location_id' => $request->location_id,
            'purchase_date' => $request->purchase_date,
            'assigned_to_user_id' => $request->assigned_to_user_id,
            'notes' => $request->notes,
        ]);

        return redirect()->route('assets.index')->with('success', 'Aset berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $asset = Asset::with('assetable')->findOrFail($id);
        $statuses = AssetStatus::orderBy('name')->get();
        $locations = AssetLocation::orderBy('name')->get();
        $users = User::orderBy('name')->get();
        $models = AssetModel::orderBy('name')->get();

        return view('forms.asset-form', compact('asset', 'statuses', 'locations', 'users', 'models'));
    }

    public function update(Request $request, $id)
    {
        $asset = Asset::with('assetable')->findOrFail($id);
        $assetType = $request->asset_type;

        // Validasi umum
        $request->validate([
            'name' => 'required|string|max:255',
            'asset_type' => 'required|in:hardware,software,digital_service',
            'status_id' => 'nullable|uuid|exists:asset_statuses,id',
            'location_id' => 'nullable|uuid|exists:asset_locations,id',
            'assigned_to_user_id' => 'nullable|uuid|exists:users,id',
            'notes' => 'nullable|string',
        ]);

        // Validasi & update detail aset
        if ($assetType === 'hardware') {
            $request->validate([
                'asset_tag' => 'required|unique:hardware_details,asset_tag,' . $asset->assetable->id,
                'serial_number' => 'required',
                'model_id' => 'required|uuid|exists:asset_models,id',
                // tambahkan validasi lain jika ada
            ]);
            $asset->assetable->update([
                'asset_tag' => $request->asset_tag,
                'serial_number' => $request->serial_number,
                'model_id' => $request->model_id,
                'warranty_expires_at' => $request->warranty_expires_at,
            ]);
        } elseif ($assetType === 'software') {
            $request->validate([
                'license_key' => 'required',
                'total_seats' => 'required|integer|min:1',
            ]);
            $asset->assetable->update([
                'license_key' => $request->license_key,
                'total_seats' => $request->total_seats,
            ]);
        } else { // digital_service
            $request->validate([
                'provider' => 'required|string|max:255',
                'service_name' => 'required|string|max:255',
            ]);
            $asset->assetable->update([
                'provider' => $request->provider,
                'service_name' => $request->service_name,
            ]);
        }

        // Update aset utama
        $asset->update([
            'name' => $request->name,
            'status_id' => $request->status_id,
            'location_id' => $request->location_id,
            'purchase_date' => $request->purchase_date,
            'assigned_to_user_id' => $request->assigned_to_user_id,
            'notes' => $request->notes,
        ]);

        return redirect()->route('assets.index')->with('success', 'Aset berhasil diupdate.');
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $asset = Asset::with('assetable')->findOrFail($id);
            // Hapus detail polymorphic terlebih dahulu
            $asset->assetable->delete();
            // Hapus aset utama
            $asset->delete();
            DB::commit();
            return redirect()->route('assets.index')->with('success', 'Aset berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('assets.index')->with('error', 'Gagal menghapus aset: ' . $e->getMessage());
        }
    }
}
