<?php
//Import
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Import Controller
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;

// Default
Route::get('/', function () {
    return view('welcome');
});

// Auth
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth.check');

// Dashboard (login required)
Route::middleware('auth.check')->group(function () {

    Route::get('/dashboard', function () {
        return response()->json([
            'message' => 'Dashboard',
            'user' => Auth::user(),
            'last_login' => session('last_login')
        ]);
    });

});

// Admin
Route::middleware(['auth.check', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class);
});

// Admin & Petugas
Route::middleware(['auth.check', 'role:admin,petugas'])->group(function () {
    Route::resource('barang', BarangController::class);
    Route::resource('supplier', SupplierController::class);
    Route::resource('barang-masuk', BarangMasukController::class);
    Route::resource('barang-keluar', BarangKeluarController::class);
});

// Manajer
Route::middleware(['auth.check', 'role:manajer'])->group(function () {
    Route::get('/laporan', function () {
        return 'Laporan Gudang';
    });
});
