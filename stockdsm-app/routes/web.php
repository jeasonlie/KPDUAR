<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});
// ->middleware(['auth', 'verified'])->name('dashboard');

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



Route::get('/barangkeluar', [BarangKeluarController::class, 'index'])->name('barangkeluar.index');
Route::post('/barangkeluar', [BarangKeluarController::class, 'store'])->name('barangkeluar.store');
Route::get('/barangkeluar/edit/{id}', [BarangKelukarController::class, 'edit'])->name('barangkeluar.edit');
Route::patch('/barangkeluar/update/{id}', [BarangeluarController::class, 'update'])->name('barangkeluar.update');
Route::get('/barangkeluar/show/{id}', [BarangKeluarController::class, 'show'])->name('barangkeluar.show');





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
