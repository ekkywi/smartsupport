<?php

namespace App\Http\Controllers\Component;

use App\Http\Controllers\Controller;
use App\Models\ComponentType;
use Illuminate\Http\Request;

class ComponentTypeController extends Controller
{
    public function index()
    {
        $componentTypes = ComponentType::all();
        return view('contents.component-type', compact('componentTypes'));
    }

    public function create()
    {
        return view('forms.component-type-form');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|unique:component_types,name',
                'component_type_tag' => 'required|string|unique:component_types,component_type_tag',
            ],
            [
                'name.required' => 'Nama jenis komponen wajib diisi.',
                'name.unique' => 'Nama jenis komponen sudah ada, atau pulihkan jenis komponen yang terhapus.',
                'component_type_tag.required' => 'Tag jenis komponen wajib diisi.',
                'component_type_tag.unique' => 'Tag jenis komponen sudah ada, atau pulihkan jenis komponen yang terhapus.',
            ]
        );

        $componentType = ComponentType::create([
            'name' => $request->name,
            'component_type_tag' => $request->component_type_tag,
        ]);

        return redirect()->route('component.types.index')->with('success', 'Jenis komponen berhasil ditambahkan.');
    }

    public function edit(ComponentType $componentType)
    {
        return view('forms.component-type-form', compact('componentType'));
    }

    public function update(Request $request, ComponentType $componentType)
    {
        $request->validate(
            [
                'name' => 'required|string|unique:component_types,name,' . $componentType->id,
                'component_type_tag' => 'required|string|unique:component_types,component_type_tag,' . $componentType->id,
            ],
            [
                'name.required' => 'Nama jenis komponen wajib diisi.',
                'name.unique' => 'Nama jenis komponen sudah ada, atau pulihkan jenis komponen yang terhapus.',
                'component_type_tag.required' => 'Tag jenis komponen wajib diisi.',
                'component_type_tag.unique' => 'Tag jenis komponen sudah ada, atau pulihkan jenis komponen yang terhapus.',
            ]
        );

        $componentType->update([
            'name' => $request->name,
            'component_type_tag' => $request->component_type_tag,
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
        $trashedComponentTypes = ComponentType::onlyTrashed()->get();
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
