<?php

namespace App\Http\Controllers\Asset;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asset;

class AssetController extends Controller
{
    public function index()
    {
        $assets = Asset::with([
            'status',
            'user',
            'location',
            'assetable.model.brand',
            'assetable.model.category'
        ])->latest()->get();

        return view('contents.asset', compact('assets'));
    }
}
