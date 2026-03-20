<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComentarioController;

Route::get('/', [ComentarioController::class, 'index'])->name('inicio');
Route::post('/comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');
