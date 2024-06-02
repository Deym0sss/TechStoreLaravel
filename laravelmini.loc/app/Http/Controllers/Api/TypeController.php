<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;
use Illuminate\Support\Facades\Log;

class TypeController extends Controller
{
    public function index()
    {
        try {
            $types = Type::all();
            Log::info('Types retrieved successfully.');
            return response()->json($types);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'An error occurred.'], 500);
        }
    }
    public function store(Request $request)
    {
        try {
            $name = $request->input('name');
            $type = Type::create(['name' => $name]);
            return response()->json($type);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'An error occurred.'], 500);
        }
    }
    public function destroy($id)
    {
        try {
            $typeToDelete = Type::destroy($id);
            return response()->json($typeToDelete);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'No id.'], 500);
        }
    }
    
}
