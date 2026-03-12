<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuiaAdiController;
use App\Http\Controllers\ClientesController;

Route::get('/', function () {
    return redirect()->route('guia-adi.index');
});

// Guia ADI
Route::resource('guia-adi', GuiaAdiController::class);
Route::prefix('guia')->group(function () {
    Route::get('/', [GuiaAdiController::class, 'index'])->name('guia-adi.index');
    Route::get('/novo', [GuiaAdiController::class, 'create'])->name('guia-adi.create');
    Route::post('/', [GuiaAdiController::class, 'store'])->name('guia-adi.store');
    Route::get('/{id}', [GuiaAdiController::class, 'show'])->name('guia-adi.show');
});

// Clientes
Route::resource('clientes', ClientesController::class);