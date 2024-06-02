<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Basket;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'role' => 'required|in:USER,ADMIN' 
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' =>$request->password,
            'role' => $request->role,
        ]);

        Basket::create(['user_id' => $user->id]);

        
        return response()->json($user);
    }

    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6'
    ]);

    $user = User::where('email', $request->email)->first();

   
    if (!$user || $user->password !== $request->password) {
        return response()->json(['error' => 'Invalid credentials'], 401);
    }

    return response()->json(['user' => $user]);
}

public function index()
{
    try {
        $users = User::all();
        return response()->json($users);
    } catch (\Exception $e) {
        Log::error($e->getMessage());
        return response()->json(['error' => 'An error occurred.'], 500);
    
    }
}


    public function show(Request $request)
    {
        $userId = $request->input('userId');
        $user = User::find($userId);

        if (!$user) {
            throw new ApiErrorException('User not found', 404);
        }

        return response()->json($user);
    }

    public function getUserByEmail(Request $request)
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'An error occurred.'], 500);
        
        }

        return response()->json($user);
    }

    public function deleteUser(Request $request)
    {
        $userId = $request->input('userId');
        $user = User::find($userId);

        if (!$user) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'An error occurred.'], 500);
        
        }

        $user->delete();
        return response()->json(['message' => 'User deleted']);
    }

 
}
