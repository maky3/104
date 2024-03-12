<?php

use App\Http\Controllers\ImageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [ImageController::class, 'index'])->name('home');
Route::post('/upload', [ImageController::class, 'upload'])->name('upload');
Route::get('/images/{id}', [ImageController::class, 'show'])->name('images.show');

Route::get('/api/images', [ImageController::class, 'apiIndex']);
Route::get('/api/images/{id}', [ImageController::class, 'apiShow']);
