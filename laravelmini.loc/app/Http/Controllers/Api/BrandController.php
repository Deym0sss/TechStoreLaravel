<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    public function store(Request $request)
    {
        try {
            $name = $request->input('name');
            $brand = Brand::create(['name' => $name]);
            return response()->json($brand);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'An error occurred.'], 500);
        
        }
    }
    public function show($id)
    {
        try {
      
            $brand = Brand::find($id);
            return response()->json( $brand, );
        } catch (\Exception $e) {
          
            return response()->json(['error' => 'An error occurred while fetching the device data.'], 500);
        }
    }

    public function index()
    {
        try {
            $brands = Brand::all();
            return response()->json($brands);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'An error occurred.'], 500);
        
        }
    }
    public function getMany(Request $request)
    {
        try {
            $ids = array_map('intval', explode(',', $request->query('ids')));
            $brands = Brand::whereIn('id', $ids)->get();
            return response()->json($brands);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'An error occurred.'], 500);
        
        }
    }
    public function destroy($id)
    {
        try {
            $brandToDelete = Brand::destroy($id);
            return response()->json($brandToDelete);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'An error occurred.'], 500);
        
        }
    }
}
