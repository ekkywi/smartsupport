<?php

namespace App\Http\Controllers\Component;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ComponentType;
use App\Models\AssetTag;
use App\Models\HardwareType;

class ComponentTypeController extends Controller
{
    public function index()
    {
        $componentTypes = ComponentType::with('assetTag')->get();
        return view('contents.component-type', compact('componentTypes'));
    }

    public function create()
    {
        $assetTags = AssetTag::all();
        return view('forms.component-type-form', compact('assetTags'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|unique:component_types,name',
                'asset_tag_id' => 'required|string|unique:component_types,asset_tag_id',
            ],
            [
                'name.required' => 'Nama jenis komponen wajib diisi.',
                'name.unique' => 'Nama jenis komponen sudah ada, atau pulihkan jenis komponen yang terhapus.',
                'asset_tag_id.required' => 'Tag jenis komponen wajib diisi.',
                'asset_tag_id.unique' => 'Tag jenis komponen sudah ada, atau pulihkan jenis komponen yang terhapus.',
            ]
        );

        $tagUsedInHardware = HardwareType::withTrashed()
            ->where('asset_tag_id', $request->asset_tag_id)
            ->exists();

        if ($tagUsedInHardware) {
            return redirect()->back()->withErrors(['asset_tag_id' => 'Tag sudah digunakan di jenis aset lain. Silakan pilih tag yang berbeda.']);
        }

        $componentType = ComponentType::create([
            'name' => $request->name,
            'asset_tag_id' => $request->asset_tag_id,
        ]);

        return redirect()->route('component.types.index')->with('success', 'Jenis komponen berhasil ditambahkan.');
    }

    public function edit(ComponentType $componentType)
    {
        $assetTags = AssetTag::all();
        return view('forms.component-type-form', compact('componentType', 'assetTags'));
    }

    public function update(Request $request, ComponentType $componentType)
    {
        $request->validate(
            [
                'name' => 'required|string|unique:component_types,name,' . $componentType->id,
                'asset_tag_id' => 'required|string|unique:component_types,asset_tag_id,' . $componentType->id,
            ],
            [
                'name.required' => 'Nama jenis komponen wajib diisi.',
                'name.unique' => 'Nama jenis komponen sudah ada, atau pulihkan jenis komponen yang terhapus.',
                'asset_tag_id.required' => 'Tag jenis komponen wajib diisi.',
                'asset_tag_id.unique' => 'Tag jenis komponen sudah ada, atau pulihkan jenis komponen yang terhapus.',
            ]
        );

        $tagUsedInHardware = HardwareType::withTrashed()
            ->where('asset_tag_id', $request->asset_tag_id)
            ->where('id', '!=', $componentType->id)
            ->exists();

        if ($tagUsedInHardware) {
            return redirect()->back()->withErrors(['asset_tag_id' => 'Tag sudah digunakan di jenis aset lain. Silakan pilih tag yang berbeda.']);
        }

        $componentType->update([
            'name' => $request->name,
            'asset_tag_id' => $request->asset_tag_id,
        ]);

        return redirect()->route('component.types.index')->with('success', 'Jenis komponen berhasil diperbarui.');
    }

    public function destroy(ComponentType $componentType)
    {
        $componentType->delete();
        return redirect()->route('component.types.index')->with('success', 'Jenis komponen berhasil dihapus.');
    }

    public function trashed()
    {
        $trashedComponentTypes = ComponentType::with('assetTag')->onlyTrashed()->get();
        return view('contents.component-type-trashed', compact('trashedComponentTypes'));
    }

    public function restore($id)
    {
        $componentType = ComponentType::onlyTrashed()->findOrFail($id);
        $componentType->restore();
        return redirect()->route('component.types.trashed')->with('success', 'Jenis komponen berhasil dipulihkan.');
    }

    public function forceDelete($id)
    {
        $componentType = ComponentType::onlyTrashed()->findOrFail($id);
        $componentType->forceDelete();
        return redirect()->route('component.types.trashed')->with('success', 'Jenis komponen berhasil dihapus secara permanen.');
    }
}
