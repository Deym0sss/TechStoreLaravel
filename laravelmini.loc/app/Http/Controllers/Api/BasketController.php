<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Basket;
use App\Models\BasketDevice;

class BasketController extends Controller
{
    public function store(Request $request)
    {
        try {
            $userId = $request->input('userId');
            $basket = Basket::create(['user_id' => $userId]);
            return response()->json($basket);
        } catch (\Exception $e) {
             Log::error($e->getMessage());
            return response()->json(['error' => 'An error occurred.'], 500);
        }
    }
    public function show($userId)
    {
        try {
            $basket = Basket::where('user_id', $userId)->get();
            if ($basket->isEmpty()) {
                return response()->json(['error' => 'Basket not found.'], 404);
            }
            return response()->json($basket);
        } catch (\Exception $e) {
             Log::error($e->getMessage());
            return response()->json(['error' => 'An error occurred.'], 500);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $userId = $request->input('userId');
            if (!$userId) {
                return response()->json(['error' => 'User ID is required.'], 400);
            }
            BasketDevice::where('user_id', $userId)->delete();
            Basket::where('user_id', $userId)->delete();
            return response()->json(['message' => 'Basket removed']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred.'], 500);
        }
    }

}
