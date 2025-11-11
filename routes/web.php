<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'index'])->name('Login');
Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login_proses');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('Dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});