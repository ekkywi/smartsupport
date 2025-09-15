<?php

namespace App\Http\Controllers\SupplierVendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return view('contents.supplier', compact('suppliers'));
    }

    public function create()
    {
        return view('forms.supplier-form');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'supplier_code' => 'required|string|unique:suppliers,supplier_code',
                'name' => 'required|string',
                'contact_person' => 'nullable|string',
                'phone' => 'nullable|string',
                'email' => 'nullable|string|email',
                'website' => 'nullable|string',
                'address' => 'nullable|string',
                'postal_code' => 'nullable|string',
                'city' => 'nullable|string',
                'province' => 'nullable|string',
                'country' => 'nullable|string',
                'notes' => 'nullable|string',
            ],
            [
                'supplier_code.required' => 'Kode supplier tidak boleh kosong.',
                'supplier_code.unique' => 'Kode supplier sudah digunakan, silahkan gunakan kode lain.',
                'name.required' => 'Nama supplier tidak boleh kosong.',
                'email.email' => 'Format email tidak valid.',
            ]
        );

        Supplier::create($request->all());
        return redirect()->route('suppliers.index')->with('success', 'Data supplier berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('forms.supplier-form', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);

        $request->validate(
            [
                'supplier_code' => 'required|string|unique:suppliers,supplier_code,' . $supplier->id,
                'name' => 'required|string',
                'contact_person' => 'nullable|string',
                'phone' => 'nullable|string',
                'email' => 'nullable|string|email',
                'website' => 'nullable|string',
                'address' => 'nullable|string',
                'postal_code' => 'nullable|string',
                'city' => 'nullable|string',
                'province' => 'nullable|string',
                'country' => 'nullable|string',
                'notes' => 'nullable|string',
            ],
            [
                'supplier_code.required' => 'Kode supplier tidak boleh kosong.',
                'supplier_code.unique' => 'Kode supplier sudah digunakan, silahkan gunakan kode lain.',
                'name.required' => 'Nama supplier tidak boleh kosong.',
                'email.email' => 'Format email tidak valid.',
            ]
        );

        $supplier->update($request->all());
        return redirect()->route('suppliers.index')->with('success', 'Data supplier berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        return redirect()->route('suppliers.index')->with('success', 'Data supplier berhasil dihapus.');
    }

    public function trashed()
    {
        $trashedSuppliers = Supplier::onlyTrashed()->get();
        return view('contents.supplier-trashed', compact('trashedSuppliers'));
    }

    public function restore($id)
    {
        $supplier = Supplier::onlyTrashed()->where('id', $id)->firstOrFail();
        $supplier->restore();
        return redirect()->route('suppliers.trashed')->with('success', 'Data supplier berhasil dipulihkan.');
    }

    public function forceDelete($id)
    {
        $supplier = Supplier::onlyTrashed()->where('id', $id)->firstOrFail();
        $supplier->forceDelete();
        return redirect()->route('suppliers.trashed')->with('success', 'Data supplier berhasil dihapus permanen.');
    }
}
