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
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

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

    // HISTORY → SEMUA ROLE
    Route::get('/history', [HistoryController::class, 'index'])
        ->name('history.index');

    /*
    |--------------------------------------------------------------------------
    | READ ONLY (ADMIN & MANAJER)
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin,manajer')->group(function () {

        // Barang (lihat saja)
        Route::get('/barang', [BarangController::class, 'index'])
            ->name('barang.index');

        // Kategori
        Route::get('/kategori', [KategoriController::class, 'index'])
            ->name('kategori.index');

        // Lokasi
        Route::get('/lokasi', [LokasiController::class, 'index'])
            ->name('lokasi.index');

        // Supplier
        Route::get('/supplier', [SupplierController::class, 'index'])
            ->name('supplier.index');

        // Tasks (lihat semua)
        Route::get('/tasks', [TaskController::class, 'index'])
            ->name('tasks.index');
    });
});

/*
|--------------------------------------------------------------------------
| ADMIN ONLY (FULL CRUD)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth.check', 'role:admin'])->group(function () {

    // Barang FULL CRUD
    Route::resource('barang', BarangController::class)->except(['index', 'show']);

    // Kategori
    Route::resource('kategori', KategoriController::class)->except(['index', 'show']);

    // Lokasi
    Route::resource('lokasi', LokasiController::class)->except(['index', 'show']);

    // Supplier FULL CRUD
    Route::resource('supplier', SupplierController::class)->except(['index', 'show']);

    // User
    Route::resource('users', UserController::class);

    // Task (buat tugas)
    Route::resource('tasks', TaskController::class)
        ->except(['index', 'show', 'edit', 'update', 'destroy']);

    // ACC & TOLAK TUGAS
    Route::post('/tasks/{task}/acc', [TaskController::class, 'approve'])
        ->name('tasks.approve');

    Route::post('/tasks/{task}/reject', [TaskController::class, 'reject'])
        ->name('tasks.reject');
});

/*
|--------------------------------------------------------------------------
| PETUGAS (OPERATOR)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth.check', 'role:petugas'])->group(function () {

    // Barang masuk & keluar (operasional)
    Route::resource('barang-masuk', BarangMasukController::class);
    Route::resource('barang-keluar', BarangKeluarController::class);

    // Tugas saya
    Route::get('/my-tasks', [TaskController::class, 'myTasks'])
        ->name('tasks.my');

    // Kirim bukti tugas
    Route::post('/tasks/{task}/complete', [TaskController::class, 'complete'])
        ->name('tasks.complete');
});

/*
|--------------------------------------------------------------------------
| PROFILE (PETUGAS & MANAJER)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth.check', 'role:manajer,petugas'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile.index');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
});
