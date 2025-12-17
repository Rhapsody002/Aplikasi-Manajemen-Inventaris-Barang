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
use App\Http\Controllers\LokasiController;

// Default
Route::get('/', function () {
    return view('welcome');
});

// Auth
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth.check');

// Dashboard (login required)
use App\Http\Controllers\DashboardController;

Route::middleware('auth.check')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
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

//Login
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

//Logout
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

//Kategori
Route::middleware(['auth.check'])->group(function () {
    Route::resource('kategori', KategoriController::class);
});
