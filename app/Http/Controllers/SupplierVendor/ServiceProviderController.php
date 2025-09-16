<?php

namespace App\Http\Controllers\SupplierVendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceProvider;

class ServiceProviderController extends Controller
{
    public function index()
    {
        $serviceProviders = ServiceProvider::all();
        return response()->json($serviceProviders);
    }

    public function create()
    {
        return view('forms.service-provider-form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_provider_code' => 'required|string|unique:service_providers,service_provider_code',
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
        ], [
            'service_provider_code.required' => 'Kode penyedia layanan tidak boleh kosong.',
            'service_provider_code.unique' => 'Kode penyedia layanan sudah digunakan, silahkan gunakan kode lain.',
            'name.required' => 'Nama penyedia layanan tidak boleh kosong.',
            'email.email' => 'Format email tidak valid.',
        ]);

        ServiceProvider::create($request->all());
        return redirect()->route('service-providers.index')->with('success', 'Data penyedia layanan berhasil ditambahkan.');
    }

    public function edit(ServiceProvider $serviceProvider)
    {
        return view('forms.service-provider-form', compact('serviceProvider'));
    }
}
