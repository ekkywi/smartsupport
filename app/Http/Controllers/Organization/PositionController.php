<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Position;

class PositionController extends Controller
{
    public function index()
    {
        $positions = Position::withCount('users')->get();
        return view('contents.organization-position-data', compact('positions'));
    }

    public function create()
    {
        return view('forms.organization-position-create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'position_name' => 'required|string|max:255|unique:positions,name',
                'position_code' => 'required|string|max:255|unique:positions,position_code',
            ],
            [
                'position_name.required' => 'Nama jabatan harus diisi.',
                'position_name.unique' => 'Nama jabatan sudah terdaftar.',
                'position_code.required' => 'Kode jabatan harus diisi.',
                'position_code.unique' => 'Kode jabatan sudah terdaftar.',
            ]
        );

        $positions = Position::create([
            'name' => $request->input('position_name'),
            'position_code' => $request->input('position_code'),
        ]);

        return redirect()->route('positions.index')->with('success', 'Jabatan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $position = Position::findOrFail($id);
        return view('forms.organization-position-edit', compact('position'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'position_name' => 'required|string|max:255|unique:positions,name,' . $id,
                'position_code' => 'required|string|max:255|unique:positions,position_code,' . $id,
            ],
            [
                'position_name.unique' => 'Nama jabatan sudah terdaftar.',
                'position_code.unique' => 'Kode jabatan sudah terdaftar.',
            ]
        );

        $position = Position::findOrFail($id);
        $position->update([
            'name' => $request->position_name,
            'position_code' => $request->position_code,
        ]);

        return redirect()->route('positions.index')->with('success', 'Jabatan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $position = Position::findOrFail($id);
        $position->delete();

        return redirect()->route('positions.index')->with('success', 'Jabatan berhasil dihapus.');
    }
}
