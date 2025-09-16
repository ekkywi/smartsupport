<?php

namespace App\Http\Controllers\SupplierVendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;

class VendorController extends Controller
{
    public function index()
    {
        $vendors = Vendor::all();
        return view('contents.vendor', compact('vendors'));
    }

    public function create()
    {
        return view('forms.vendor-form');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'vendor_code' => 'required|string|unique:vendors,vendor_code',
                'name' => 'required|string',
                'contact_person' => 'nullable|string',
                'phone' => 'nullable|string',
                'email' => 'nullable|string|email',
                'website' => 'nullable|string|max:255',
                'address' => 'nullable|string',
                'postal_code' => 'nullable|string',
                'city' => 'nullable|string',
                'province' => 'nullable|string',
                'country' => 'nullable|string',
                'notes' => 'nullable|string',
            ],
            [
                'vendor_code.required' => 'Kode vendor tidak boleh kosong.',
                'vendor_code.unique' => 'Kode vendor sudah digunakan, silahkan gunakan kode lain.',
                'name.required' => 'Nama vendor tidak boleh kosong.',
                'email.email' => 'Format email tidak valid.',
            ]
        );

        Vendor::create($request->all());
        return redirect()->route('vendors.index')->with('success', 'Data vendor berhasil ditambahkan.');
    }

    public function edit(Vendor $vendor)
    {
        return view('forms.vendor-form', compact('vendor'));
    }

    public function update(Request $request, Vendor $vendor)
    {
        $request->validate(
            [
                'vendor_code' => 'required|string|unique:vendors,vendor_code,' . $vendor->id,
                'name' => 'required|string',
                'contact_person' => 'nullable|string',
                'phone' => 'nullable|string',
                'email' => 'nullable|string|email',
                'website' => 'nullable|string|max:255',
                'address' => 'nullable|string',
                'postal_code' => 'nullable|string',
                'city' => 'nullable|string',
                'province' => 'nullable|string',
                'country' => 'nullable|string',
                'notes' => 'nullable|string',
            ],
            [
                'vendor_code.required' => 'Kode vendor tidak boleh kosong.',
                'vendor_code.unique' => 'Kode vendor sudah digunakan, silahkan gunakan kode lain.',
                'name.required' => 'Nama vendor tidak boleh kosong.',
                'email.email' => 'Format email tidak valid.',
            ]
        );

        $vendor->update($request->all());
        return redirect()->route('vendors.index')->with('success', 'Data vendor berhasil diperbarui.');
    }

    public function destroy(Vendor $vendor)
    {
        $vendor->delete();
        return redirect()->route('vendors.index')->with('success', 'Data vendor berhasil dihapus.');
    }

    public function trashed()
    {
        $trashedVendors = Vendor::onlyTrashed()->get();
        return view('contents.vendor-trashed', compact('trashedVendors'));
    }

    public function restore(Vendor $vendor)
    {
        $vendor->restore();
        return redirect()->route('vendors.trashed')->with('success', 'Data vendor berhasil dipulihkan.');
    }

    public function forceDelete(Vendor $vendor)
    {
        $vendor->forceDelete();
        return redirect()->route('vendors.trashed')->with('success', 'Data vendor berhasil dihapus permanen.');
    }
}
