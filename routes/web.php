<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/register', [UserController::class, 'register'])->name('user.register');
Route::get('/', [UserController::class, 'login'])->name('user.login');
Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');
Route::get('/forgot', [UserController::class, 'forgot_password'])->name('user.forgot');
Route::post('/forgot', [UserController::class, 'reset_password'])->name('user.reset');
Route::post('/register', [UserController::class, 'store'])->name('user.store');
Route::post('/login', [UserController::class, 'auth'])->name('user.auth');

Route::get('qr/{id}', [PageController::class, 'detail_barang_public'])->name('barang.detail.public');

Route::middleware(['auth'])->group(function () {
    Route::get('/menu', [PageController::class, 'menu'])->name('menu');
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
    Route::get('/scan', [PageController::class, 'scan'])->name('scan');
    Route::get('/laporan', [PageController::class, 'laporan'])->name('laporan');
    Route::get('/laporan/print', [PageController::class, 'laporan_print_pdf'])->name('laporan.print');
    Route::get('/laporan/export', [PageController::class, 'laporan_export_pdf'])->name('laporan.export');

    Route::prefix('/master')->group(function () {
        Route::get('/kategori', [PageController::class, 'master_kategori'])->name('master.kategori');
        Route::post('/kategori/create', [MainController::class, 'tambah_kategori'])->name('master.kategori.create');
        Route::put('/kategori/{id}/update', [MainController::class, 'update_kategori'])->name('master.kategori.update');
        Route::delete('/kategori', [MainController::class, 'hapus_kategori'])->name('master.kategori.hapus');
        Route::get('/users', [PageController::class, 'master_users'])->name('master.users');
        Route::post('/users/create', [MainController::class, 'tambah_user'])->name('master.users.create');
        Route::put('/users/{id}/update', [MainController::class, 'update_user'])->name('master.users.update');
        Route::delete('/users', [MainController::class, 'hapus_user'])->name('master.users.hapus');
    });

    Route::prefix('/barang')->group(function () {
        Route::get('/', [PageController::class, 'barang_stok'])->name('barang.stok');
        Route::get('/{id}/detail', [PageController::class, 'detail_barang'])->name('barang.detail');
        Route::post('/tambah', [MainController::class, 'tambah_barang'])->name('barang.tambah');
        Route::delete('/hapus', [MainController::class, 'hapus_barang'])->name('barang.hapus');
        Route::get('/masuk', [PageController::class, 'barang_masuk'])->name('barang.masuk');
        Route::post('/masuk/create', [MainController::class, 'barang_masuk'])->name('barang.masuk.create');
        Route::delete('/masuk', [MainController::class, 'hapus_barang_masuk'])->name('barang.masuk.hapus');
        Route::get('/keluar', [PageController::class, 'barang_keluar'])->name('barang.keluar');
        Route::post('/keluar/create', [MainController::class, 'barang_keluar'])->name('barang.keluar.create');
        Route::delete('/keluar', [MainController::class, 'hapus_barang_keluar'])->name('barang.keluar.hapus');
    });
});