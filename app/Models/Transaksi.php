<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = "table_transaksi";
    public $timestamps = false;
     protected $casts = [
        'created_at' => 'datetime',
    ];

    protected $fillable = ['layanan', 'berat', 'nama_pelanggan', 'keterangan'];
}
