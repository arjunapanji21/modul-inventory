<?php

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

Route::middleware(['auth'])->group(function () {
    Route::get('/menu', [PageController::class, 'menu'])->name('menu');
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
    Route::get('/laporan', [PageController::class, 'laporan'])->name('laporan');

    Route::prefix('/barang')->group(function () {
        Route::get('/', [PageController::class, 'barang_stok'])->name('barang.stok');
        Route::get('/in', [PageController::class, 'barang_masuk'])->name('barang.masuk');
        Route::get('/out', [PageController::class, 'barang_keluar'])->name('barang.keluar');
    });
});