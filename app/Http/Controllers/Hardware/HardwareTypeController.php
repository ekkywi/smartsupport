<?php

namespace App\Http\Controllers\Hardware;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HardwareType;
use App\Models\ComponentType;
use App\Models\AssetTag;

class HardwareTypeController extends Controller
{
    public function index()
    {
        $hardwareTypes = HardwareType::with('assetTag')->get();
        return view("contents.hardware-type", compact("hardwareTypes"));
    }

    public function create(Request $request)
    {
        $assetTags = AssetTag::all();
        return view('forms.hardware-type-form', compact('assetTags'));
    }

    public function store(Request $request)
    {
        request()->validate(
            [
                'name' => 'required|unique:hardware_types,name',
                'asset_tag_id' => 'required|unique:hardware_types,asset_tag_id',
            ],
            [
                'name.required' => 'Nama jenis hardware wajib diisi.',
                'name.unique' => 'Nama jenis hardware sudah ada, atau pulihkan jenis hardware yang terhapus.',
                'asset_tag_id.required' => 'Tag jenis hardware wajib diisi.',
                'asset_tag_id.unique' => 'Tag jenis hardware sudah ada, atau pulihkan jenis hardware yang terhapus.',
            ]
        );

        $tagUsedInComponent = ComponentType::withTrashed()
            ->where('asset_tag_id', $request->asset_tag_id)
            ->exists();

        if ($tagUsedInComponent) {
            return redirect()->back()->withErrors(['asset_tag_id' => 'Tag sudah digunakan di jenis aset lain. Silakan pilih tag yang berbeda.']);
        }

        $hardwareType = HardwareType::create([
            'name' => $request->name,
            'asset_tag_id' => $request->asset_tag_id,
        ]);

        return redirect()->route("hardware.types.index")->with("success", "Jenis hardware berhasil ditambahkan.");
    }

    public function edit(HardwareType $hardwareType)
    {
        $assetTags = AssetTag::all();
        return view('forms.hardware-type-form', compact('hardwareType', 'assetTags'));
    }

    public function update(Request $request, HardwareType $hardwareType)
    {
        request()->validate(
            [
                'name' => 'required|unique:hardware_types,name,' . $hardwareType->id,
                'asset_tag_id' => 'required|unique:hardware_types,asset_tag_id,' . $hardwareType->id,
            ],
            [
                'name.required' => 'Nama jenis hardware wajib diisi.',
                'name.unique' => 'Nama jenis hardware sudah ada, atau pulihkan jenis hardware yang terhapus.',
                'asset_tag_id.required' => 'Tag jenis hardware wajib diisi.',
                'asset_tag_id.unique' => 'Tag jenis hardware sudah ada, atau pulihkan jenis hardware yang terhapus.',
            ]
        );

        $tagUsedInComponent = ComponentType::withTrashed()
            ->where('asset_tag_id', $request->asset_tag_id)
            ->where('id', '!=', $hardwareType->id)
            ->exists();

        if ($tagUsedInComponent) {
            return redirect()->back()->withErrors(['asset_tag_id' => 'Tag sudah digunakan di jenis aset lain. Silakan pilih tag yang berbeda.']);
        }

        $hardwareType->update([
            'name' => $request->name,
            'asset_tag_id' => $request->asset_tag_id,
        ]);

        return redirect()->route("hardware.types.index")->with("success", "Jenis hardware berhasil diperbarui.");
    }

    public function destroy(HardwareType $hardwareType)
    {
        $hardwareType->delete();
        return redirect()->route("hardware.types.index")->with("success", "Jenis hardware berhasil dihapus.");
    }

    public function trashed()
    {
        $trashedHardwareTypes = HardwareType::onlyTrashed()->get();
        return view('contents.hardware-type-trashed', compact('trashedHardwareTypes'));
    }

    public function restore($id)
    {
        $hardwareType = HardwareType::onlyTrashed()->where('id', $id)->firstOrFail();
        $hardwareType->restore();
        return redirect()->route("hardware.types.trashed")->with("success", "Jenis hardware berhasil dipulihkan.");
    }

    public function forceDelete($id)
    {
        $hardwareType = HardwareType::onlyTrashed()->where('id', $id)->firstOrFail();
        $hardwareType->forceDelete();
        return redirect()->route("hardware.types.trashed")->with("success", "Jenis hardware berhasil dihapus permanen.");
    }
}
