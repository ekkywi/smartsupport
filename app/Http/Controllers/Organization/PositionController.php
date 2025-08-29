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
        return view('contents.organization-position', compact('positions'));
    }

    public function create()
    {
        return view('forms.organization-position-form');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255|unique:positions,name',
                'position_code' => 'required|string|max:255|unique:positions,position_code',
            ],
            [
                'name.required' => 'Nama jabatan harus diisi.',
                'name.unique' => 'Nama jabatan sudah terdaftar.',
                'position_code.required' => 'Kode jabatan harus diisi.',
                'position_code.unique' => 'Kode jabatan sudah terdaftar.',
            ]
        );

        $positions = Position::create([
            'name' => $request->input('name'),
            'position_code' => $request->input('position_code'),
        ]);

        return redirect()->route('positions.index')->with('success', 'Jabatan berhasil ditambahkan.');
    }

    public function edit(Position $position)
    {
        return view('forms.organization-position-form', compact('position'));
    }

    public function update(Request $request, Position $position)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255|unique:positions,name,' . $position->id,
                'position_code' => 'required|string|max:255|unique:positions,position_code,' . $position->id,
            ],
            [
                'name.unique' => 'Nama jabatan sudah terdaftar.',
                'position_code.unique' => 'Kode jabatan sudah terdaftar.',
            ]
        );

        $position->update([
            'name' => $request->name,
            'position_code' => $request->position_code,
        ]);

        return redirect()->route('positions.index')->with('success', 'Jabatan berhasil diperbarui.');
    }

    public function destroy(Position $position)
    {
        $position->delete();

        return redirect()->route('positions.index')->with('success', 'Jabatan berhasil dihapus.');
    }
}
