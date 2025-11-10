<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;

Route::get('/', [BerandaController::class, 'index']);
Route::get('/layanan', [LayananController::class, 'index']);
Route::get('/transaksi', [TransaksiController::class, 'index']);
Route::post('/transaksi/store', [TransaksiController::class, 'store']);
Route::post('/transaksi/update/{id}', [TransaksiController::class, 'update']);
Route::post('/transaksi/delete/{id}', [TransaksiController::class, 'destroy']);
Route::get('/transaksi/print/{id}', [TransaksiController::class, 'print'])->name('transaksi.print');

Route::post('/layanan/store', [LayananController::class, 'store']);
Route::post('/layanan/update/{id}', [LayananController::class, 'update']);
Route::post('/layanan/delete/{id}', [LayananController::class, 'destroy']);

Route::get('/layanan/export', [LayananController::class, 'export']);
Route::post('/layanan/import', [LayananController::class, 'import']);

Route::get('transaksi/export', [TransaksiController::class, 'export']);
Route::post('transaksi/import', [TransaksiController::class, 'import']);

Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.laporan' );