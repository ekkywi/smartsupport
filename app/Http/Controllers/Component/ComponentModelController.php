<?php

namespace App\Http\Controllers\Component;

use App\Http\Controllers\Controller;
use Illuminate\Console\View\Components\Component;
use Illuminate\Http\Request;
use App\Models\ComponentModel;

class ComponentModelController extends Controller
{
    public function index()
    {
        $componentModels = ComponentModel::with(['componentType', 'brand'])->get();
        return view('contents.component-model', compact('componentModels'));
    }
}
