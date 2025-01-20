<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\InputAspirasiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('siswa', App\Http\Controllers\SiswaController::class)->middleware('auth');

Route::resource('kategori', App\Http\Controllers\KategoriController::class)->middleware('auth');
//Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');


Route::resource('inputaspirasi', App\Http\Controllers\InputAspirasiController::class)->middleware('auth');

Route::get('/home', [HomeController::class, 'index'])->name('home');
//Route::get('/kategori', [KategoriController::class, 'index'])->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
