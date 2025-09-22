<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('.dashboard.beranda');
});
Route::get('/layanan', function () {
    return view('layanan.layanan');
});
Route::get('/transaksi', function () {
    return view('transaksi.transaksi');
});

