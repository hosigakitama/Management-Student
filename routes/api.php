<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AbsensiController;

// API untuk siswa
Route::post('/register-rfid', [SiswaController::class, 'registerRFID']);
Route::put('/update-siswa/{id}', [SiswaController::class, 'updateSiswa']);
Route::get('/siswa', [SiswaController::class, 'getAllSiswa']);
Route::get('/siswa/{uid_kartu}', [SiswaController::class, 'getSiswaByUID']);

// API untuk absensi
Route::post('/absen', [AbsensiController::class, 'absen']);
Route::get('/absensi', [AbsensiController::class, 'getAllAbsensi']);
Route::get('/absensi/{uid_kartu}', [AbsensiController::class, 'getAbsensiByUID']);


// test
Route::get('test', function () {
    return response()->json(['message' => 'keren nih bisa!']);
});
