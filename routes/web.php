<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\DaftarItemController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\PelangganLoginController;

Route::get('/', function () {
    return redirect('/login');
})->name('home');

Route::get('/login', [PelangganLoginController::class, 'index'])->name('url_login');
Route::post('/login', [PelangganLoginController::class, 'login'])->name('login');
Route::get('/logout', [PelangganLoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth:pelangganweb'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/daftar-item', [DaftarItemController::class, 'index'])->name('daftar_item');
    Route::get('/daftar-item/json', [DaftarItemController::class, 'json'])->name('dafter_item_json');
    Route::get('/daftar-item/filter_json', [DaftarItemController::class, 'filter_json'])->name('daftar_item_filter_json');
});

Route::get('/admin', function () {
    return redirect('/admin/login');
});

Route::get('/admin/login', [AdminLoginController::class, 'index'])->name('url_admin_login');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin_login');
Route::get('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin_logout');

Route::group(['middleware' => 'auth:web'], function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin_dashboard');
    // Route::get('/daftar-item', [DaftarItemController::class, 'index'])->name('daftar_item');
    // Route::get('/daftar-item/json', [DaftarItemController::class, 'json'])->name('dafter_item_json');
    // Route::get('/daftar-item/filter_json', [DaftarItemController::class, 'filter_json'])->name('daftar_item_filter_json');
});