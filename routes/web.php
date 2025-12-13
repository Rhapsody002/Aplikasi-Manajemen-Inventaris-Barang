<?php

//Default routing
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('welcome');
});

//Routing For Kategori
use App\Http\Controllers\KategoriController;

