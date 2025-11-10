<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Layanan;

class Transaksi extends Model
{
    protected $table = "table_transaksi";
    public $timestamps = false;
     protected $casts = [
        'created_at' => 'datetime',
    ];
public function getTotalHargaAttribute()
{
    $harga_satuan = Layanan::where('nama_layanan', $this->layanan)->value('harga_satuan') ?? 0;
    return $harga_satuan * $this->berat;
}
    protected $fillable = ['created_at','layanan', 'berat', 'nama_pelanggan', 'keterangan'];
}
