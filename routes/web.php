<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

use App\Http\Controllers\ZIController;

// Tampilkan halaman utama
Route::get('/', [ZIController::class, 'index'])->name('zi.index');
// Route untuk sinkronisasi manual
Route::get('/sync', [ZIController::class, 'syncStatus'])->name('zi.sync');