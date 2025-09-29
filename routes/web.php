<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\TransaksiController;

Route::get('/', [BerandaController::class, 'index']);
Route::get('/layanan', [LayananController::class, 'index']);
Route::get('/transaksi', [TransaksiController::class, 'index']);
Route::post('/transaksi/store', [TransaksiController::class, 'store']);
Route::post('/transaksi/update/{id}', [TransaksiController::class, 'update']);
Route::post('/transaksi/delete/{id}', [TransaksiController::class, 'destroy']);

Route::post('/layanan/store', [LayananController::class, 'store']);
Route::post('/layanan/update/{id}', [LayananController::class, 'update']);
Route::post('/layanan/delete/{id}', [LayananController::class, 'destroy']);