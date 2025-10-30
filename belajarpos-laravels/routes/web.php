<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BelajarController;
use App\Http\Controllers\CalculatorController;

// Route::get('/', function () {
//     // return view('welcome');
//     return view('belajar');
// });
Route::get('/', [BelajarController::class, 'index']);

// get: preview / menampilkan
// Route::get('belajar', [\App\Http\Controllers\BelajarController::class, 'index']);
Route::get('belajar/tambah', [BelajarController::class, 'tambah'])->name('belajar.tambah');
Route::get('belajar/kurang', [BelajarController::class, 'kurang'])->name('belajar.kurang');


// post: mengirim sebuah data melalui form
Route::post('storeTambah', [BelajarController::class, 'storeTambah'])->name('storeTambah');
Route::post('storeKurang', [BelajarController::class, 'storeKurang'])->name('storeKurang');

Route::get('belajar/calculator', [CalculatorController::class, 'create'])->name('belajar.calculator');
Route::post('calculator/create', [CalculatorController::class, 'store'])->name('calculator.store');
// put: mengirim sebuah data melalui form tpi update
// delete: mengirim sebuah data melalui form tpi hapus
