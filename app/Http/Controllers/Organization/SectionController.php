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
}
