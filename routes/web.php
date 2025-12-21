<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Controllers
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

/*
|--------------------------------------------------------------------------
| LOGIN REQUIRED (SEMUA ROLE)
|--------------------------------------------------------------------------
*/
Route::middleware('auth.check')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | READ ONLY (SEMUA ROLE BOLEH LIHAT)
    |--------------------------------------------------------------------------
    */
    Route::get('/kategori', [KategoriController::class, 'index'])
        ->name('kategori.index');

    Route::get('/lokasi', [LokasiController::class, 'index'])
        ->name('lokasi.index');
});

/*
|--------------------------------------------------------------------------
| ADMIN ONLY (FULL CRUD)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth.check', 'role:admin'])->group(function () {

    // Kategori
    Route::resource('kategori', KategoriController::class)
        ->except(['index', 'show']);

    // Lokasi
    Route::resource('lokasi', LokasiController::class)
        ->except(['index', 'show']);

    // User
    Route::resource('users', UserController::class);

    //Task
    Route::resource('tasks', TaskController::class)->except('show');
});

/*
|--------------------------------------------------------------------------
| ADMIN & PETUGAS
|--------------------------------------------------------------------------
*/
Route::middleware(['auth.check', 'role:admin,petugas'])->group(function () {

    Route::resource('barang', BarangController::class);
    Route::resource('supplier', SupplierController::class);
    Route::resource('barang-masuk', BarangMasukController::class);
    Route::resource('barang-keluar', BarangKeluarController::class);
});

/*
|--------------------------------------------------------------------------
| PETUGAS
|--------------------------------------------------------------------------
*/
Route::get('/my-tasks', [TaskController::class, 'myTasks'])->name('tasks.my');
    Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus'])
        ->name('tasks.updateStatus');

/*
|--------------------------------------------------------------------------
| MANAJER
|--------------------------------------------------------------------------
*/
Route::middleware(['auth.check', 'role:manajer'])->group(function () {
    Route::get('/laporan', function () {
        return 'Laporan Gudang';
    });
});
