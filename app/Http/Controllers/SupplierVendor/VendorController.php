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

    public function edit($id)
    {
        $vendor = Vendor::findOrFail($id);
        return view('forms.vendor-form', compact('vendor'));
    }

    public function update(Request $request, $id)
    {
        $vendor = Vendor::findOrFail($id);

        $request->validate(
            [
                'vendor_code' => 'required|string|unique:vendors,vendor_code,' . $vendor->id,
                'name' => 'required|string',
                'contact_person' => 'nullable|string',
                'phone' => 'nullable|string',
                'email' => 'nullable|string|email',
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

    public function destroy($id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->delete();
        return redirect()->route('vendors.index')->with('success', 'Data vendor berhasil dihapus.');
    }

    public function trashed()
    {
        $vendors = Vendor::onlyTrashed()->get();
        return view('contents.vendor-trashed', compact('vendors'));
    }

    public function restore($id)
    {
        $vendor = Vendor::onlyTrashed()->where('id', $id)->firstOrFail();
        $vendor->restore();
        return redirect()->route('vendors.index')->with('success', 'Data vendor berhasil dipulihkan.');
    }

    public function forceDelete($id)
    {
        $vendor = Vendor::onlyTrashed()->where('id', $id)->firstOrFail();
        $vendor->forceDelete();
        return redirect()->route('vendors.trashed')->with('success', 'Data vendor berhasil dihapus permanen.');
    }
}
