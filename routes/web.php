<?php

use App\Http\Controllers\backend\ArtikelController;
use App\Http\Controllers\backend\categoryController;
use App\Http\Controllers\backend\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index']); //Tampilan menud utama admin

Route::resource('article', ArtikelController::class); //Akses tampilan fitur artikel admin

Route::resource('/category', categoryController::class)->only(['index', 'store', 'update', 'destroy']); //Akses tampilan fitur kategori admin
