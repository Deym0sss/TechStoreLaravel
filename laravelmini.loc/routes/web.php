<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('storage/{filename}',"StaticController@index" );

// Route::get('storage/{filename}', [StaticController::class, 'index'])->where('filename', '.*');
// Route::get([StaticController::class, 'index']);
// function ($filename) {
//     $path = Storage::disk('public')->path($filename);
    
//     if (!Storage::disk('public')->exists($filename)) {
//         abort(404);
//     }

//     return response()->file($path);
// })->where('filename', '.*');