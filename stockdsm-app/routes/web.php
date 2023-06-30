<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'preventBackHistory'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
    Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
    Route::get('/barang/edit/{id}', [BarangController::class, 'edit'])->name('barang.edit');
    Route::patch('/barang/update/{id}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/barang/destory/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');

    Route::get('/barangmasuk', [BarangMasukController::class, 'index'])->name('barangmasuk.index');
    Route::post('/barangmasuk', [BarangMasukController::class, 'store'])->name('barangmasuk.store');
    Route::get('/barangmasuk/edit/{id}', [BarangMasukController::class, 'edit'])->name('barangmasuk.edit');
    Route::patch('/barangmasuk/update/{id}', [BarangMasukController::class, 'update'])->name('barangmasuk.update');
    Route::get('/barangmasuk/show/{id}', [BarangMasukController::class, 'show'])->name('barangmasuk.show');
    Route::get('/barangmasuk/print/{id}', [BarangMasukController::class, 'print'])->name('barangmasuk.print');

    Route::get('/barangkeluar', [BarangKeluarController::class, 'index'])->name('barangkeluar.index');
    Route::post('/barangkeluar', [BarangKeluarController::class, 'store'])->name('barangkeluar.store');
    Route::get('/barangkeluar/edit/{id}', [BarangKeluarController::class, 'edit'])->name('barangkeluar.edit');
    Route::patch('/barangkeluar/update/{id}', [BarangKeluarController::class, 'update'])->name('barangkeluar.update');
    Route::get('/barangkeluar/show/{id}', [BarangKeluarController::class, 'show'])->name('barangkeluar.show');
    Route::get('/barangkeluar/print/{id}', [BarangKeluarController::class, 'print'])->name('barangkeluar.print');

    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::patch('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');
});

require __DIR__.'/auth.php';
