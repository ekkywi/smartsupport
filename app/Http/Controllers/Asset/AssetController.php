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
            'assetable' => function ($morphTo) {
                $morphTo->morphWith([
                    HardwareDetail::class => ['model.brand', 'model.category'],
                ]);
            }
        ])->latest()->get();

        return view('contents.asset', compact('assets'));
    }

    public function create()
    {
        $locations = AssetLocation::orderBy('name')->get();
        $users = User::orderBy('name')->get();
        $models = AssetModel::orderBy('name')->get();

        return view('forms.asset-form', compact('locations', 'users', 'models'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'asset_type' => 'required|in:hardware,software,digital_service',
            'location_id' => 'nullable|uuid|exists:asset_locations,id',
            'assigned_to_user_id' => 'nullable|uuid|exists:users,id',
            'notes' => 'nullable|string',
            'purchase_date' => 'nullable|date'
        ]);

        if ($request->asset_type === 'hardware') {
            $assetModel = AssetModel::with('category')->findOrFail($request->model_id);
            $categoryTag = $assetModel->category->category_tag ?? 'TAG';

            $user = User::with('section')->find($request->assigned_to_user_id);
            $sectionCode = ($user && $user->section) ? $user->section->section_code : 'SEC';

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
                'expiry_date' => 'nullable|date'

            ]);
            $softwareLicense = SoftwareDetail::create([
                'license_key' => $request->license_key,
                'total_seats' => $request->total_seats,
                'expiry_date' => $request->expiry_date,
            ]);
            $assetableType = SoftwareDetail::class;
            $assetableId = $softwareLicense->id;
        } else {
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

        $statusTersedia = AssetStatus::where('name', 'Tersedia')->firstOrFail();

        Asset::create([
            'name' => $request->name,
            'assetable_type' => $assetableType,
            'assetable_id' => $assetableId,
            'status_id' => $statusTersedia->id,
            'location_id' => $request->location_id,
            'purchase_date' => $request->purchase_date,
            'assigned_to_user_id' => $request->assigned_to_user_id,
            'notes' => $request->notes,
            'expiry_date' => $request->expiry_date,
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
        $asset = Asset::with(['assetable', 'user.section'])->findOrFail($id);
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

            $hardwareDetail = $asset->assetable;

            $oldUserId = $asset->assigned_to_user_id;
            $newUserId = $request->assigned_to_user_id;

            $oldSectionCode = optional($asset->user->section)->section_code ?? 'SEC';
            $newUser = User::with('section')->find($newUserId);
            $newSectionCode = optional($newUser->section)->section_code ?? 'SEC';

            if ($oldUserId !== $newUserId && $oldSectionCode !== $newSectionCode) {
                $assetModel = AssetModel::with('category')->findOrFail($request->model_id);
                $categoryTag = $assetModel->category->category_tag ?? 'TAG';

                $uniqueNumber = strtoupper(Str::random(8));

                $assetTagNew = "$categoryTag-$newSectionCode-$uniqueNumber";
                $hardwareDetail->asset_tag = $assetTagNew;
            }
            $hardwareDetail->serial_number = $request->serial_number;
            $hardwareDetail->model_id = $request->model_id;
            $hardwareDetail->warranty_expires_at = $request->warranty_expires_at;
            $hardwareDetail->save();
        } elseif ($assetType === 'software') {
            $request->validate([
                'license_key' => 'required|string|max:255',
                'total_seats' => 'required|integer|min:1',
                'expiry_date' => 'nullable|date',
            ]);
            $asset->assetable->update([
                'license_key' => $request->license_key,
                'total_seats' => $request->total_seats,
                'expiry_date' => $request->expiry_date,
            ]);
        } else {
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
            'expiry_date' => $request->expiry_date,
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
            'assetable' => function ($morphTo) {
                $morphTo->morphWith([
                    HardwareDetail::class => ['model.brand', 'model.category'],
                ]);
            }
        ])->findOrFail($id);

        return view('contents.asset-detail', compact('asset'));
    }
}
