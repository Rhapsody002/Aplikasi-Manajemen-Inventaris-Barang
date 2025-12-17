<?php

//Default routing
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('welcome');
});

//Routing For Kategori
use App\Http\Controllers\KategoriController;

//Route For Login,Logout & Check
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

Route::get('/dashboard', function () {

    if (!Auth::check()) {
        return response()->json([
            'message' => 'Unauthorized'
        ], 401);
    }

    return response()->json([
        'message'    => 'Dashboard',
        'user'       => Auth::user(),
        'last_login' => session('last_login')
    ]);

});

//Middleware
Route::middleware('auth.check')->group(function () {

    Route::get('/dashboard', function () {
        return response()->json([
            'message' => 'Dashboard',
            'user' => Auth::user(),
        ]);
    });

});

