<?php

use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Route;


// route dengan method get untuk menampilkan semua gambar sekaligus halaman utama
// route akan memanggil function index untuk menampilkan semua gambar
Route::get('/', [GalleryController::class, 'index'])->name('index');

// route dengan method post untuk menyimpan gambar yang diupload
// route akan memanggil function store di GalleryController
Route::post('/upload', [GalleryController::class, 'store'])->name('store');

// route put untuk mengupdate gambar berdasarkan id
// route akan memanggil function update di GalleryController
Route::put('/{id}', [GalleryController::class, 'update'])->name('update');

// route dengan method delete untuk menghapus gambar berdasarkan id
// route akan memanggil function destroy di GalleryController
Route::delete('/{id}', [GalleryController::class, 'destroy'])->name('delete');


