<?php

namespace App\Http\Controllers\Asset;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
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
            'user.section',
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
        $request->validate([
            'name' => 'required|string|max:255',
            'asset_type' => 'required|in:hardware,software,digital_service',
            'status_id' => 'nullable|uuid|exists:asset_statuses,id',
            'location_id' => 'nullable|uuid|exists:asset_locations,id',
            'assigned_to_user_id' => 'nullable|uuid|exists:users,id',
            'notes' => 'nullable|string',
            'purchase_date' => 'nullable|date'
        ]);

        if ($request->asset_type === 'hardware') {
            // Ambil model & category_tag
            $assetModel = AssetModel::with('category')->findOrFail($request->model_id);
            $categoryTag = $assetModel->category->category_tag ?? 'TAG';

            // Ambil user yang menerima aset dan section_code-nya
            $user = User::with('section')->find($request->assigned_to_user_id);
            $sectionCode = ($user && $user->section) ? $user->section->section_code : 'SEC';

            // Penomoran unik
            $uniqueNumber = strtoupper(Str::random(8));
            $assetTag = "$categoryTag-$sectionCode-$uniqueNumber";

            $request->validate([
                'serial_number' => 'nullable|string|max:255',
                'model_id' => 'required|uuid|exists:asset_models,id',
                'warranty_expires_at' => 'nullable|date'
            ]);

            $hardwareDetail = HardwareDetail::create([
                'asset_tag' => $assetTag,
                'serial_number' => $request->serial_number,
                'model_id' => $request->model_id,
                'warranty_expires_at' => $request->warranty_expires_at,
            ]);
            $assetableType = HardwareDetail::class;
            $assetableId = $hardwareDetail->id;
        } elseif ($request->asset_type === 'software') {
            $request->validate([
                'license_key' => 'required|string|max:255',
                'total_seats' => 'required|integer|min:1',
            ]);
            $softwareLicense = SoftwareDetail::create([
                'license_key' => $request->license_key,
                'total_seats' => $request->total_seats,
            ]);
            $assetableType = SoftwareDetail::class;
            $assetableId = $softwareLicense->id;
        } else { // digital_service
            $request->validate([
                'provider' => 'required|string|max:255',
                'service_name' => 'required|string|max:255',
            ]);
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
        $asset = Asset::with(['assetable'])->findOrFail($id);
        $statuses = AssetStatus::orderBy('name')->get();
        $locations = AssetLocation::orderBy('name')->get();
        $users = User::orderBy('name')->get();
        $models = AssetModel::orderBy('name')->get();

        return view('forms.asset-form', compact('asset', 'statuses', 'locations', 'users', 'models'));
    }

    public function update(Request $request, $id)
    {
        $asset = Asset::with(['assetable'])->findOrFail($id);
        $assetType = $request->asset_type;

        $request->validate([
            'name' => 'required|string|max:255',
            'asset_type' => 'required|in:hardware,software,digital_service',
            'status_id' => 'nullable|uuid|exists:asset_statuses,id',
            'location_id' => 'nullable|uuid|exists:asset_locations,id',
            'assigned_to_user_id' => 'nullable|uuid|exists:users,id',
            'notes' => 'nullable|string',
            'purchase_date' => 'nullable|date'
        ]);

        if ($assetType === 'hardware') {
            $request->validate([
                'serial_number' => 'nullable|string|max:255',
                'model_id' => 'required|uuid|exists:asset_models,id',
                'warranty_expires_at' => 'nullable|date',
            ]);
            // asset_tag tidak perlu diupdate, tetap pakai yang lama
            $asset->assetable->update([
                // 'asset_tag' => $asset->assetable->asset_tag, // JANGAN izinkan edit asset_tag!
                'serial_number' => $request->serial_number,
                'model_id' => $request->model_id,
                'warranty_expires_at' => $request->warranty_expires_at,
            ]);
        } elseif ($assetType === 'software') {
            $request->validate([
                'license_key' => 'required|string|max:255',
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
            $asset->assetable->delete();
            $asset->delete();
            DB::commit();
            return redirect()->route('assets.index')->with('success', 'Aset berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('assets.index')->with('error', 'Gagal menghapus aset: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $asset = Asset::with([
            'status',
            'user.section',
            'location',
            'assetable.model.brand',
            'assetable.model.category'
        ])->findOrFail($id);

        return view('contents.asset-detail', compact('asset'));
    }
}
