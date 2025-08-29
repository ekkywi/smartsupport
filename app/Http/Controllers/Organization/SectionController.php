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
        return view('contents.organization-section', compact('sections'));
    }

    public function create()
    {
        return view('forms.organization-section-form');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255|unique:sections,name',
                'section_code' => 'required|string|max:255|unique:sections,section_code',
            ],
            [
                'name.required' => 'Nama bagian harus diisi.',
                'name.unique' => 'Nama bagian sudah terdaftar.',
                'section_code.required' => 'Kode bagian harus diisi.',
                'section_code.unique' => 'Kode bagian sudah terdaftar.',
            ]
        );

        $section = Section::create([
            'name' => $request->name,
            'section_code' => $request->section_code
        ]);

        return redirect()->route('sections.index')->with('success', 'Bagian berhasil ditambahkan.');
    }

    public function edit(Section $section)
    {
        return view('forms.organization-section-form', compact('section'));
    }

    public function update(Request $request, Section $section)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255|unique:sections,name,' . $section->id,
                'section_code' => 'required|string|max:255|unique:sections,section_code,' . $section->id,
            ],
            [
                'name.required' => 'Nama bagian harus diisi.',
                'section_code.required' => 'Kode bagian harus diisi.',
                'name.unique' => 'Nama bagian sudah terdaftar.',
                'section_code.unique' => 'Kode bagian sudah terdaftar.',
            ]
        );

        $section->update([
            'name' => $request->name,
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
