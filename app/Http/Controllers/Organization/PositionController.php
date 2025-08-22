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
}
