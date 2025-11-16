<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PemainController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'index'])->name('Login');
Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login_proses');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('Dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Route::get('/pemain', [PemainController::class, 'index'])->name('Pemain');
    Route::controller(PemainController::class)->group(function () {
        Route::get('/pemain', 'index')->name('index.pemain');
        Route::get('/pemain/create', 'create')->name('create.pemain');
        Route::post('/pemain/store', 'store')->name('store.pemain');
        Route::get('/pemain/edit/{id}', 'edit')->name('edit.pemain');
        Route::post('/pemain/update/{id}', 'update')->name('update.pemain');
        Route::delete('/pemain/delete/{id}', 'destroy')->name('delete.pemain');
    });
});