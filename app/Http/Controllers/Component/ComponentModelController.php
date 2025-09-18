<?php

namespace App\Http\Controllers\Component;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ComponentModel;
use App\Models\ComponentType;
use App\Models\Brand;

class ComponentModelController extends Controller
{
    public function index()
    {
        $componentModels = ComponentModel::with(['componentType'])->get();
        return view('contents.component-model', compact('componentModels'));
    }

    public function create()
    {
        $componentTypes = ComponentType::all();
        $brands = Brand::all();
        return view('forms.component-model-form', compact('componentTypes', 'brands'));
    }
}
