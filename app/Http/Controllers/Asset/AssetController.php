<?php

namespace App\Http\Controllers\Asset;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        $request->validate([
            'name' => 'required|string|max:255',
            'asset_type' => 'required|in:hardware,software,digital_service',
            'status_id' => 'nullable|uuid|exists:asset_statuses,id',
            'location_id' => 'nullable|uuid|exists:asset_locations,id',
            'user_id' => 'nullable|uuid|exists:users,id',
            'notes' => 'nullable|string'
        ]);

        if ($request->asset_type === 'hardware') {
            $hardwareDetail = HardwareDetail::create([
                'asset_tag' => $request->asset_tag,
                'serial_number' => $request->serial_number,
                'model_id' => $request->model_id,
                // ... field hardware lain sesuai kebutuhan
            ]);
            $assetableType = HardwareDetail::class;
            $assetableId = $hardwareDetail->id;
        } elseif ($request->asset_type === 'software') {
            $softwareLicense = SoftwareDetail::create([
                'license_key' => $request->license_key,
                'total_seats' => $request->total_seats,
                // ... field software lain sesuai kebutuhan
            ]);
            $assetableType = SoftwareDetail::class;
            $assetableId = $softwareLicense->id;
        } else {
            $digitalService = DigitalService::create([
                'provider' => $request->provider,
                'service_name' => $request->service_name,
                // ... field digital service lain sesuai kebutuhan
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
            'user_id' => $request->user_id,
            'notes' => $request->notes,
        ]);

        return redirect()->route('assets.index')->with('success', 'Aset berhasil ditambahkan.');
    }
}
