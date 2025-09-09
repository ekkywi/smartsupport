<?php

namespace App\Http\Controllers\Hardware;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HardwareType;

class HardwareTypeController extends Controller
{
    public function index()
    {
        $hardwareTypes = HardwareType::all();
        return view("contents.hardware-type", compact("hardwareTypes"));
    }

    public function create()
    {
        return view('forms.hardware-type-form');
    }

    public function store(Request $request)
    {
        request()->validate(
            [
                'name' => 'required|unique:hardware_types,name',
                'hardware_type_tag' => 'required|unique:hardware_types,hardware_type_tag',
            ],
            [
                'name.required' => 'Nama jenis hardware wajib diisi.',
                'name.unique' => 'Nama jenis hardware sudah ada, atau pulihkan jenis hardware yang terhapus.',
                'hardware_type_tag.required' => 'Tag jenis hardware wajib diisi.',
                'hardware_type_tag.unique' => 'Tag jenis hardware sudah ada, atau pulihkan jenis hardware yang terhapus.',
            ]
        );

        HardwareType::create($request->all());
        return redirect()->route("hardware.types.index")->with("success", "Jenis hardware berhasil ditambahkan.");
    }

    public function edit(HardwareType $hardwareType)
    {
        return view('forms.hardware-type-form', compact('hardwareType'));
    }

    public function update(Request $request, HardwareType $hardwareType)
    {
        request()->validate(
            [
                'name' => 'required|unique:hardware_types,name,' . $hardwareType->id,
                'hardware_type_tag' => 'required|unique:hardware_types,hardware_type_tag,' . $hardwareType->id,
            ],
            [
                'name.required' => 'Nama jenis hardware wajib diisi.',
                'name.unique' => 'Nama jenis hardware sudah ada, atau pulihkan jenis hardware yang terhapus.',
                'hardware_type_tag.required' => 'Tag jenis hardware wajib diisi.',
                'hardware_type_tag.unique' => 'Tag jenis hardware sudah ada, atau pulihkan jenis hardware yang terhapus.',
            ]
        );

        $hardwareType->update($request->all());
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
