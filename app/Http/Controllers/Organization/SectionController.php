<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::withCount('users')->get();
        return view('contents.organization-section-data', compact('sections'));
    }

    public function create()
    {
        return view('forms.organization-section-create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'section_name' => 'required|string|max:255|unique:sections,name',
                'section_code' => 'required|string|max:255|unique:sections,section_code',
            ],
            [
                'section_name.required' => 'Nama bagian harus diisi.',
                'section_name.unique' => 'Nama bagian sudah terdaftar.',
                'section_code.required' => 'Kode bagian harus diisi.',
                'section_code.unique' => 'Kode bagian sudah terdaftar.',
            ]
        );

        $section = Section::create([
            'name' => $request->section_name,
            'section_code' => $request->section_code
        ]);

        return redirect()->route('sections.index')->with('success', 'Bagian berhasil ditambahkan.');
    }

    public function edit(Section $section)
    {
        return view('forms.organization-section-edit', compact('section'));
    }

    public function update(Request $request, Section $section)
    {
        $request->validate(
            [
                'section_name' => 'required|string|max:255|unique:sections,name,' . $section->id,
                'section_code' => 'required|string|max:255|unique:sections,section_code,' . $section->id,
            ],
            [
                'section_name.required' => 'Nama bagian harus diisi.',
                'section_code.required' => 'Kode bagian harus diisi.',
                'section_name.unique' => 'Nama bagian sudah terdaftar.',
                'section_code.unique' => 'Kode bagian sudah terdaftar.',
            ]
        );

        $section->update([
            'name' => $request->section_name,
            'section_code' => $request->section_code
        ]);

        return redirect()->route('sections.index')->with('success', 'Bagian berhasil diperbarui.');
    }

    public function destroy(Section $section)
    {
        $section->delete();

        return redirect()->route('sections.index')->with('success', 'Bagian berhasil dihapus.');
    }
}
