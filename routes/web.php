<?php

// use App\Http\Controllers\AdminController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ZIController;
use Illuminate\Support\Facades\Route;
use App\Livewire\PclMonitoring;
use App\Livewire\PilarMonitoring;

// Jadikan halaman monitoring sebagai halaman utama (root)
Route::get('/', PclMonitoring::class)->name('home');

// Halaman yang hanya bisa diakses setelah login
Route::middleware('auth')->group(function () {
    // Halaman Utama (Dashboard)
    Route::get('/dashboard', [ZIController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
    
    // Halaman Monitoring
    Route::get('/monitoring', [MonitoringController::class, 'index'])->name('monitoring');
    
    Route::get('/monitoring/pilar', PilarMonitoring::class)->name('monitoring.pilar');


    // Grup untuk Halaman Admin
    // Route::middleware('admin')->group(function () { // 'admin' middleware bisa dibuat nanti
    //     Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    // });

    // Rute untuk migrasi (JANGAN LUPA DIHAPUS SETELAH SELESAI)
    // Route::get('/migrate-drive', [ZIController::class, 'migrateDriveStructure']);
    //Route::get('/sync', [ZIController::class, 'syncStatus'])->name('zi.sync');

    // Rute profil bawaan Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // UNTUK TESTING
    // Route::get('/jalankan-tes-migrasi-drive', function () {
    //     // Panggil method controller yang akan kita buat nanti
    //     return app(\App\Http\Controllers\ZIController::class)->testMigrateDriveStructure();
    // })->middleware('auth'); // Lindungi dengan auth agar hanya user yang login bisa akses

});

require __DIR__.'/auth.php';