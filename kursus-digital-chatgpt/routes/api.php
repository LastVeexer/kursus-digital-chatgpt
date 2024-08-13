<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KursusController;
use App\Http\Controllers\PendaftaranController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Berikut adalah definisi route untuk API. Masing-masing route akan
| diarahkan ke controller yang sesuai untuk menangani operasi CRUD.
|
*/

// Route untuk manajemen data siswa
Route::apiResource('siswa', SiswaController::class);

// Route untuk manajemen data kursus
Route::apiResource('kursus', KursusController::class);

// Route untuk manajemen data pendaftaran
Route::apiResource('pendaftaran', PendaftaranController::class);
