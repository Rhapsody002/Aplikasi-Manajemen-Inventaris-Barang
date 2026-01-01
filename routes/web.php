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


// Route::get('/', function () {
//     return view('welcome');
// });

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

    /*
    |--------------------------------------------------------------------------
    | READ ONLY (SEMUA ROLE BOLEH LIHAT)
    |--------------------------------------------------------------------------
    */

    //Barang
    Route::get('/barang', [BarangController::class, 'index'])
        ->name('barang.index');

    // Kategori
    Route::get('/kategori', [KategoriController::class, 'index'])
        ->name('kategori.index');

    // Lokasi
    Route::get('/lokasi', [LokasiController::class, 'index'])
        ->name('lokasi.index');

    // Supplier (READ ONLY)
    Route::get('/supplier', [SupplierController::class, 'index'])
        ->name('supplier.index');

    //History
    Route::get('/history', [HistoryController::class, 'index'])
        ->name('history.index');
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

    // Task (ADMIN buat tugas)
    Route::resource('tasks', TaskController::class)
        ->except(['show', 'edit', 'update', 'destroy']);

    // Supplier CRUD (ADMIN ONLY)
    Route::get('/supplier/create', [SupplierController::class, 'create'])
        ->name('supplier.create');

    Route::post('/supplier', [SupplierController::class, 'store'])
        ->name('supplier.store');

    Route::get('/supplier/{supplier}/edit', [SupplierController::class, 'edit'])
        ->name('supplier.edit');

    Route::put('/supplier/{supplier}', [SupplierController::class, 'update'])
        ->name('supplier.update');

    Route::delete('/supplier/{supplier}', [SupplierController::class, 'destroy'])
        ->name('supplier.destroy');
});

/*
|--------------------------------------------------------------------------
| ADMIN & PETUGAS
|--------------------------------------------------------------------------
*/
Route::middleware(['auth.check', 'role:admin,petugas'])->group(function () {

    Route::resource('barang', BarangController::class);
    Route::resource('barang-masuk', BarangMasukController::class);
    Route::resource('barang-keluar', BarangKeluarController::class);
});

/*
|--------------------------------------------------------------------------
| PETUGAS
|--------------------------------------------------------------------------
*/
Route::middleware(['auth.check', 'role:petugas'])->group(function () {

    // Tugas saya
    Route::get('/my-tasks', [TaskController::class, 'myTasks'])
        ->name('tasks.my');

    // Selesaikan tugas
    Route::post('/tasks/{task}/complete', [TaskController::class, 'complete'])
        ->name('tasks.complete');
});

/*
|--------------------------------------------------------------------------
| PETUGAS
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