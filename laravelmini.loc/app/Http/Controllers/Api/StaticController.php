<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class StaticController extends Controller
{
    public function index($filename)
    {
        $path = Storage::disk('public')->path($filename);
    
        if (!Storage::disk('public')->exists($filename)) {
            abort(404);
        }
    
        return response()->view('devicePage', ['filename' => $filename])
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'POST, OPTIONS')
            ->header('Access-Control-Allow-Headers', 'Content-Type, X-Requested-With');
    }
}
