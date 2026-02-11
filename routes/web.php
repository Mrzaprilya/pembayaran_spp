<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SppController;
use App\Http\Controllers\AdminSiswaController;
use App\Http\Controllers\AdminPetugasController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\Admin\PembayaranController as AdminPembayaranController;

/*
|--------------------------------------------------------------------------
| LANDING
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'doLogin'])->name('doLogin');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| ADMIN PANEL
|--------------------------------------------------------------------------
| URL: /admin
*/
Route::middleware(['admin'])->prefix('admin')->group(function () {

    Route::get('/', [AdminController::class, 'index'])
        ->name('admin.dashboard');

    Route::resource('kelas', KelasController::class);
    Route::resource('spp', SppController::class);
    Route::resource('siswa', AdminSiswaController::class);
    
    // Validation routes for AJAX
    Route::get('siswa/validate-nisn/{nisn}', [AdminSiswaController::class, 'validateNisn'])
        ->name('siswa.validate.nisn');
    Route::get('siswa/validate-nis/{nis}', [AdminSiswaController::class, 'validateNis'])
        ->name('siswa.validate.nis');
    
    Route::resource('petugas', AdminPetugasController::class);

    Route::get('pembayaran', [AdminPembayaranController::class, 'index'])
        ->name('admin.pembayaran.index');

    Route::get('/pembayaran/excel', [AdminPembayaranController::class, 'exportExcel'])
        ->name('admin.pembayaran.excel');
});

/*
|--------------------------------------------------------------------------
| PETUGAS PANEL
|--------------------------------------------------------------------------
| URL: /petugas
*/
Route::middleware(['petugas'])->prefix('petugas')->group(function () {

    // DASHBOARD
    Route::get('/', [PetugasController::class, 'index'])
        ->name('petugas.dashboard');

    // PEMBAYARAN
    Route::get('/pembayaran', [PembayaranController::class, 'index'])
        ->name('petugas.pembayaran.index');

    Route::get('/pembayaran/create', [PembayaranController::class, 'create'])
        ->name('petugas.pembayaran.create');

    Route::post('/pembayaran', [PembayaranController::class, 'store'])
        ->name('petugas.pembayaran.store');

    // CETAK BUKTI PEMBAYARAN
    Route::get('/pembayaran/{id}/cetak', [PembayaranController::class, 'cetak'])
        ->name('petugas.pembayaran.cetak');
});

/*
|--------------------------------------------------------------------------
| SISWA PANEL
|--------------------------------------------------------------------------
| URL: /siswa
*/
Route::middleware(['siswa'])->group(function () {

    Route::get('/siswa', [SiswaController::class, 'dashboard'])
        ->name('siswa.dashboard');

    Route::get('/siswa/history', [SiswaController::class, 'history'])
        ->name('siswa.history');
});
