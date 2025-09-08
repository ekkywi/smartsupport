<?php

namespace App\Http\Controllers\SystemLog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssetStatusLog;

class AssetStatusLogController extends Controller
{
    public function index()
    {
        $assetStatusLogs = AssetStatusLog::with('user', 'assetStatus')->latest()->get();
        return view('contents.asset-status-log', compact('assetStatusLogs'));
    }
}
