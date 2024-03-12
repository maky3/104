<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;

Route::get('/images', [ImageController::class, 'index'])->name('images.index');
Route::get('/images/{id}', [ImageController::class, 'show'])->name('images.show');
Route::post('/images', [ImageController::class, 'store'])->name('images.store');
Route::put('/images/{id}', [ImageController::class, 'update'])->name('images.update');
Route::patch('/images/{id}', [ImageController::class, 'update'])->name('images.update');
Route::delete('/images/{id}', [ImageController::class, 'destroy'])->name('images.destroy');

Route::get('/', function () {
    return view('welcome');
});
