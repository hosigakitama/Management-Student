<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\SiswaManagementController;
use App\Http\Controllers\FonnteController;

Route::get('/send-message', [FonnteController::class, 'sendMessage']);

Route::get('/', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //siswa
    Route::get('/siswa', [SiswaManagementController::class, 'index'])->name('siswa.index');
    Route::get('/siswa/edit/{id}', [SiswaManagementController::class, 'edit'])->name('siswa.edit');
    Route::put('/siswa/update/{id}', [SiswaManagementController::class, 'update'])->name('siswa.update');


    //riwayat absensi
    Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.index');
    Route::get('/api/absensi', [AbsensiController::class, 'getAbsensi'])->name('get.absensi');

    // download absensi dalam format excel
    // Route::get('/absensi/download', [AbsensiController::class, 'downloadAbsensi'])->name('absensi.download');

    Route::get('/absensi-info', [AbsensiController::class, 'info'])->name('absensi.info');
});


require __DIR__.'/auth.php';
// require base_path('routes/counselor.php');
