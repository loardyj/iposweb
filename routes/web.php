<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\DaftarItemController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\KelolaAdminController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\PelangganLoginController;
use App\Http\Middleware\DynamicDatabaseMiddleware;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;

Route::get('/', function () {
    return redirect('/login');
})->name('home');

Route::get('/login', [PelangganLoginController::class, 'index'])->name('url_login');
Route::post('/login', [PelangganLoginController::class, 'login'])->name('login');
Route::get('/logout', [PelangganLoginController::class, 'logout'])->name('logout');

Route::middleware(['auth:pelangganweb'])->group(function () {  
    Route::get('/daftar-item', [DaftarItemController::class, 'index'])->name('daftar_item');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/daftar-item/json', [DaftarItemController::class, 'json'])->name('daftar_item_json');
    Route::get('/daftar-item/filter_json', [DaftarItemController::class, 'filter_json'])->name('daftar_item_filter_json');
    Route::get('/keranjang/json', [KeranjangController::class, 'json'])->name('keranjang.json');
});

Route::post('/keranjang/update', [KeranjangController::class, 'update'])->name('keranjang.update')->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/keranjang/delete', [KeranjangController::class, 'destroy'])->name('keranjang.destroy')->withoutMiddleware([VerifyCsrfToken::class]);

Route::get('/admin', function () {
    return redirect('/admin/login');
});

Route::get('/admin/login', [AdminLoginController::class, 'index'])->name('url_admin_login');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin_login');
Route::get('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin_logout');

Route::group(['middleware' => 'auth:adminweb'], function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin_dashboard');

    Route::get('/admin/kelola-admin', [KelolaAdminController::class, 'index'])->name('kelola_admin');
    Route::get('/admin/kelola-admin/json', [KelolaAdminController::class, 'json'])->name('kelola_admin.json');
    Route::get('/admin/kelola-admin/json/{id}', [KelolaAdminController::class, 'json_show'])->name('kelola_admin.json_show');
    Route::post('/admin/kelola-admin', [KelolaAdminController::class, 'store'])->name('kelola_admin.store');
    Route::put('/admin/kelola-admin', [KelolaAdminController::class, 'update'])->name('kelola_admin.update');
    Route::delete('/admin/kelola-admin/{id}', [KelolaAdminController::class, 'destroy'])->name('kelola_admin.destroy');    

    Route::get('/admin/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan');
    Route::put('/admin/pengaturan', [PengaturanController::class, 'update'])->name('pengaturan.update');
});