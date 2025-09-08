<?php

namespace App\Http\Controllers\Component;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ComponentTypeController extends Controller
{
    public function index()
    {
        return view('contents.component-type');
    }
}
