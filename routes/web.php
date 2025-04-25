<?php

use App\Http\Controllers\ImagenController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified', AdminMiddleware::class])->group(function () {
    Route::get('/dashboard', [ProductoController::class,'index']
    )->name('productos.index');
    Route::get('/productos/create', [ProductoController::class,'create']
    )->name('productos.create');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
