<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HasilPerhitunganController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\LatihanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PemainController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\PerhitunganController;
use App\Http\Controllers\PosisiController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'index'])->name('Login');
Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login_proses');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('Dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::controller(KriteriaController::class)->group(function () {
        Route::get('/kriteria', 'index')->name('index.kriteria');
        Route::get('/kriteria/create', 'create')->name('create.kriteria');
        Route::post('/kriteria/store', 'store')->name('store.kriteria');
        Route::get('/kriteria/edit/{id}', 'edit')->name('edit.kriteria');
        Route::post('/kriteria/update/{id}', 'update')->name('update.kriteria');
        Route::delete('/kriteria/delete/{id}', 'destroy')->name('delete.kriteria');
    });

    Route::controller(PosisiController::class)->group(function () {
        Route::get('/posisi', 'index')->name('index.posisi');
        Route::get('/posisi/create', 'create')->name('create.posisi');
        Route::post('/posisi/store', 'store')->name('store.posisi');
        Route::get('/posisi/edit/{id}', 'edit')->name('edit.posisi');
        Route::post('/posisi/update/{id}', 'update')->name('update.posisi');
        Route::delete('/posisi/delete/{id}', 'destroy')->name('delete.posisi');
    });

    Route::controller(PemainController::class)->group(function () {
        Route::get('/pemain', 'index')->name('index.pemain');
        Route::get('/pemain/create', 'create')->name('create.pemain');
        Route::post('/pemain/store', 'store')->name('store.pemain');
        Route::get('/pemain/edit/{id}', 'edit')->name('edit.pemain');
        Route::post('/pemain/update/{id}', 'update')->name('update.pemain');
        Route::delete('/pemain/delete/{id}', 'destroy')->name('delete.pemain');
    });

    Route::controller(LatihanController::class)->group(function () {
        Route::get('/latihan', 'index')->name('index.latihan');
        Route::get('/latihan/create', 'create')->name('create.latihan');
        Route::post('/latihan/store', 'store')->name('store.latihan');
        Route::get('/latihan/edit/{id}', 'edit')->name('edit.latihan');
        Route::post('/latihan/update/{id}', 'update')->name('update.latihan');
        Route::delete('/latihan/delete/{id}', 'destroy')->name('delete.latihan');
    });

    Route::controller(PenilaianController::class)->group(function () {
        Route::get('/penilaian', 'index')->name('index.penilaian');
        // Route::get('/penilaian/create', 'create')->name('create.penilaian');
        // Route::post('/penilaian/store', 'store')->name('store.penilaian');
        Route::get('/penilaian/edit/{id}', 'edit')->name('edit.penilaian');
        Route::post('/penilaian/update/{id}', 'update')->name('update.penilaian');
        // Route::delete('/penilaian/delete/{id}', 'destroy')->name('delete.penilaian');
    });

    Route::controller(PerhitunganController::class)->group(function () {
        Route::get('/perhitungan', 'index')->name('index.perhitungan');
        Route::get('/perhitungan/edit/{id}', 'edit')->name('edit.perhitungan');
        Route::post('/perhitungan/update/{id}', 'update')->name('update.perhitungan');
    });

    Route::controller(HasilPerhitunganController::class)->group(function () {
        Route::get('/hasilPerhitungan', 'index')->name('index.hasilPerhitungan');
        Route::get('/hasilPerhitungan/edit/{id}', 'edit')->name('edit.hasilPerhitungan');
        Route::post('/hasilPerhitungan/update/{id}', 'update')->name('update.hasilPenilaian');
        Route::get('/hasil/export/pdf', 'exportPdf')->name('hasil.export.pdf');
        Route::get('/hasil/export/csv', 'exportExcel')->name('hasil.export.excel');

    });








    Route::controller(PenggunaController::class)->group(function () {
        Route::get('/pengguna', 'index')->name('index.pengguna');
        Route::get('/pengguna/create', 'create')->name('create.pengguna');
        Route::post('/pengguna/store', 'store')->name('store.pengguna');
        Route::get('/pengguna/edit/{id}', 'edit')->name('edit.pengguna');
        Route::post('/pengguna/update/{id}', 'update')->name('update.pengguna');
        Route::delete('/pengguna/delete/{id}', 'destroy')->name('delete.pemain');
    });
});