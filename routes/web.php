<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Databarang\KategoriController;
use App\Http\Controllers\Databarang\BarangController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\Laporan\LaporanBarangController;
use App\Http\Controllers\Laporan\LaporanBarangMasukController;
use App\Http\Controllers\Laporan\LaporanBarangKeluarController;

Route::get('/', [DashboardController::class, 'index'])->name('index');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('databarang/kategori', [KategoriController::class, 'index'])->name('databarang.kategori.index');
Route::post('databarang/kategori', [KategoriController::class, 'store'])->name('databarang.kategori.store');
Route::put('databarang/kategori/{kodekategori}', [KategoriController::class, 'update'])->name('databarang.kategori.update');
Route::delete('databarang/kategori/{kodekategori}', [KategoriController::class, 'destroy'])->name('databarang.kategori.destroy');
Route::get('/get-kodebarang/{kodekategori}', [App\Http\Controllers\Databarang\BarangController::class, 'getKodeBarang']);

Route::get('databarang/barang', [BarangController::class, 'index'])->name('databarang.barang.index');
Route::post('databarang/barang', [BarangController::class, 'store'])->name('databarang.barang.store');
Route::put('databarang/barang/{kodebarang}', [BarangController::class, 'update'])->name('databarang.barang.update');
Route::delete('databarang/barang/{kodebarang}', [BarangController::class, 'destroy'])->name('databarang.barang.destroy');
Route::get('/get-kodebarang/{kodekategori}', [BarangController::class, 'getKodeBarang']);

Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier.index');
Route::post('/supplier', [SupplierController::class, 'store'])->name('supplier.store');
Route::put('/supplier/{id}', [SupplierController::class, 'update'])->name('supplier.update');
Route::delete('/supplier/{id}', [SupplierController::class, 'destroy'])->name('supplier.destroy');

Route::get('/pembeli', [PembeliController::class, 'index'])->name('pembeli.index');
Route::post('/pembeli', [PembeliController::class, 'store'])->name('pembeli.store');
Route::put('/pembeli/{id}', [PembeliController::class, 'update'])->name('pembeli.update');
Route::delete('/pembeli/{id}', [PembeliController::class, 'destroy'])->name('pembeli.destroy');

Route::get('/barang-masuk', [BarangMasukController::class, 'index'])->name('barangmasuk.index');
Route::post('/barang-masuk', [BarangMasukController::class, 'store'])->name('barangmasuk.store');
Route::delete('/barang-masuk/{id}', [BarangMasukController::class, 'destroy'])->name('barangmasuk.destroy');

Route::get('/barang-keluar', [BarangKeluarController::class, 'index'])->name('barangkeluar.index');
Route::post('/barang-keluar', [BarangKeluarController::class, 'store'])->name('barangkeluar.store');
Route::delete('/barang-keluar/{id}', [BarangKeluarController::class, 'destroy'])->name('barangkeluar.destroy');
Route::get('/get-nama-barang/{kodebarang}', [App\Http\Controllers\BarangKeluarController::class, 'getNamaBarang']);

Route::get('/laporan/barang', [LaporanBarangController::class, 'index'])->name('laporan.barang.index');
Route::get('/laporan/barang/cetak-pdf', [LaporanBarangController::class, 'cetakPDF'])->name('laporan.barang.pdf');

Route::get('/laporan/barangmasuk', [LaporanBarangMasukController::class, 'index'])->name('laporan.barangmasuk.index');
Route::get('/laporan/barangmasuk/cetak-pdf', [LaporanBarangMasukController::class, 'cetakPDF'])->name('laporan.barangmasuk.pdf');

Route::get('/laporan/barangkeluar', [LaporanBarangKeluarController::class, 'index'])->name('laporan.barangkeluar.index');
Route::get('/laporan/barangkeluar/cetak-pdf', [LaporanBarangKeluarController::class, 'cetakPDF'])->name('laporan.barangkeluar.pdf');


