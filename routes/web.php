<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PemainController;
use App\Http\Controllers\PenggunaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'index'])->name('Login');
Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login_proses');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('Dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::controller(PemainController::class)->group(function () {
        Route::get('/pemain', 'index')->name('index.pemain');
        Route::get('/pemain/create', 'create')->name('create.pemain');
        Route::post('/pemain/store', 'store')->name('store.pemain');
        Route::get('/pemain/edit/{id}', 'edit')->name('edit.pemain');
        Route::post('/pemain/update/{id}', 'update')->name('update.pemain');
        Route::delete('/pemain/delete/{id}', 'destroy')->name('delete.pemain');
    });

    Route::controller(KriteriaController::class)->group(function () {
        Route::get('/kriteria', 'index')->name('index.kriteria');
        Route::get('/kriteria/create', 'create')->name('create.kriteria');
        Route::post('/kriteria/store', 'store')->name('store.kriteria');
        Route::get('/kriteria/edit/{id}', 'edit')->name('edit.kriteria');
        Route::post('/kriteria/update/{id}', 'update')->name('update.kriteria');
        Route::delete('/kriteria/delete/{id}', 'destroy')->name('delete.kriteria');
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