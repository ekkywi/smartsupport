<?php

namespace App\Http\Controllers\SupplierVendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('contents.brand', compact('brands'));
    }

    public function create()
    {
        return view('forms.brand-form');
    }

    public function store(Request $request)
    {
        request()->validate(
            [
                'name' => 'required|unique:brands,name',
                'brand_tag' => 'required|unique:brands,brand_tag',
            ],
            [
                'name.required' => 'Nama brand wajib diisi.',
                'name.unique' => 'Nama brand sudah ada, atau pulihkan brand yang terhapus.',
                'brand_tag.required' => 'Tag brand wajib diisi.',
                'brand_tag.unique' => 'Tag brand sudah ada, atau pulihkan brand yang terhapus.',
            ]
        );

        Brand::create($request->all());
        return redirect()->route('brands.index')->with('success', 'Brand berhasil ditambahkan.');
    }

    public function edit(Brand $brand)
    {
        return view('forms.brand-form', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        request()->validate(
            [
                'name' => 'required|unique:brands,name,' . $brand->id,
                'brand_tag' => 'required|unique:brands,brand_tag,' . $brand->id,
            ],
            [
                'name.required' => 'Nama brand wajib diisi.',
                'name.unique' => 'Nama brand sudah ada, atau pulihkan brand yang terhapus.',
                'brand_tag.required' => 'Tag brand wajib diisi.',
                'brand_tag.unique' => 'Tag brand sudah ada, atau pulihkan brand yang terhapus.',
            ]
        );

        $brand->update($request->all());
        return redirect()->route('brands.index')->with('success', 'Brand berhasil diperbarui.');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('brands.index')->with('success', 'Brand berhasil dihapus.');
    }

    public function trashed()
    {
        $trashedBrands = Brand::onlyTrashed()->get();
        return view('contents.brand-trashed', compact('trashedBrands'));
    }

    public function restore(Brand $brand)
    {
        $brand->restore();
        return redirect()->route('brands.trashed')->with('success', 'Brand berhasil dipulihkan.');
    }

    public function forceDelete(Brand $brand)
    {
        $brand->forceDelete();
        return redirect()->route('brands.trashed')->with('success', 'Brand berhasil dihapus permanen.');
    }
}
