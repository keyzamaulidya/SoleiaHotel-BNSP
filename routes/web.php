<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PemesananController;

// Halaman Utama / Home
Route::get('/', function () {
    return view('Home');
})->name('home');

// Halaman Formulir Pemesanan (Menggunakan Controller)
Route::get('/formulir-pemesanan', [PemesananController::class, 'create'])->name('pemesanan.create');
Route::post('/formulir-pemesanan/store', [PemesananController::class, 'store'])->name('pemesanan.store');

// Halaman Rincian Pemesanan
Route::get('/rincian-pemesanan', [PemesananController::class, 'index'])->name('pemesanan.index');

Route::get('/pemesanan/{id}/cetak', [PemesananController::class, 'cetak'])->name('pemesanan.cetak');
Route::get('/pemesanan/{id}/detail', [PemesananController::class, 'detail'])->name('pemesanan.detail');
// Route tambahan navigasi 
Route::get('/produk', function () { return view('Home'); })->name('produk');
Route::get('/harga', function () { return view('Home'); })->name('harga');
Route::get('/tentang', function () { return view('Home'); })->name('tentang');
Route::get('/pesan', function () { return view('Home'); })->name('pesan');