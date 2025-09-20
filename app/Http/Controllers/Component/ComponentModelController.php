<?php

namespace App\Http\Controllers\Component;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ComponentModel;
use App\Models\ComponentType;
use App\Models\Brand;

class ComponentModelController extends Controller
{
    public function index()
    {
        $componentModels = ComponentModel::with(['componentType'])->get();
        return view('contents.component-model', compact('componentModels'));
    }

    public function create()
    {
        $componentTypes = ComponentType::all();
        $brands = Brand::all();
        return view('forms.component-model-form', compact('componentTypes', 'brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:component_models,name',
            'component_model_code' => 'nullable|string|unique:component_models,component_model_code',
            'component_type_id' => 'required|exists:component_types,id',
            'brand_id' => 'required|exists:brands,id',
            'specs' => 'nullable|array',
            'description' => 'nullable|string',
        ], [
            'name.required' => 'Nama model komponen wajib diisi.',
            'name.unique' => 'Nama model komponen sudah ada, atau pulihkan model komponen yang terhapus.',
            'component_model_code.unique' => 'Kode model komponen sudah ada, atau pulihkan model komponen yang terhapus.',
            'component_type_model.required' => 'Model tipe komponen wajib diisi.',
            'component_type_id.required' => 'Tipe komponen wajib diisi.',
            'component_type_id.exists' => 'Tipe komponen tidak ditemukan.',
            'brand_id.required' => 'Merek wajib diisi.',
            'brand_id.exists' => 'Merek tidak ditemukan.',
            'specs.array' => 'Spesifikasi harus berupa array.',
        ]);

        $componentModel = ComponentModel::create([
            'name' => $request->name,
            'component_model_code' => $request->component_model_code,
            'component_type_id' => $request->component_type_id,
            'brand_id' => $request->brand_id,
            'specs' => $request->specs,
            'description' => $request->description,
        ]);

        return redirect()->route('component.models.index')->with('success', 'Model komponen berhasil ditambahkan.');
    }

    public function edit(ComponentModel $componentModel)
    {
        $componentModel->specs = is_string($componentModel->specs)
            ? json_decode($componentModel->specs, true) ?? []
            : ($componentModel->specs ?? []);
        $componentTypes = ComponentType::all();
        $brands = Brand::all();
        return view('forms.component-model-form', compact('componentModel', 'componentTypes', 'brands'));
    }

    public function update(Request $request, ComponentModel $componentModel)
    {
        $request->validate([
            'name' => 'required|string|unique:component_models,name,' . $componentModel->id,
            'component_model_code' => 'nullable|string|unique:component_models,component_model_code,' . $componentModel->id,
            'component_type_id' => 'required|exists:component_types,id',
            'brand_id' => 'required|exists:brands,id',
            'specs' => 'nullable|array',
            'description' => 'nullable|string',
        ], [
            'name.required' => 'Nama model komponen wajib diisi.',
            'name.unique' => 'Nama model komponen sudah ada, atau pulihkan model komponen yang terhapus.',
            'component_model_code.unique' => 'Kode model komponen sudah ada, atau pulihkan model komponen yang terhapus.',
            'component_type_id.required' => 'Tipe komponen wajib diisi.',
            'component_type_id.exists' => 'Tipe komponen tidak ditemukan.',
            'brand_id.required' => 'Merek wajib diisi.',
            'brand_id.exists' => 'Merek tidak ditemukan.',
            'specs.array' => 'Spesifikasi harus berupa array.',
        ]);

        $componentModel->update([
            'name' => $request->name,
            'component_model_code' => $request->component_model_code,
            'component_type_id' => $request->component_type_id,
            'brand_id' => $request->brand_id,
            'specs' => $request->specs,
            'description' => $request->description,
        ]);

        return redirect()->route('component.models.index')->with('success', 'Model komponen berhasil diperbarui.');
    }

    public function destroy(ComponentModel $componentModel)
    {
        $componentModel->delete();
        return redirect()->route('component.models.index')->with('success', 'Model komponen berhasil dihapus.');
    }
}
