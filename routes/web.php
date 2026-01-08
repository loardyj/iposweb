<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DaftarItemController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth:pelangganweb'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/daftar-item', [DaftarItemController::class, 'index']);
    Route::get('/daftar-item/json', [DaftarItemController::class, 'json']);
    Route::get('/daftar-item/filter_json', [DaftarItemController::class, 'filter_json']);
});
