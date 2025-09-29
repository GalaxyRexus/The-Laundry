<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use function Laravel\Prompts\table;
use App\Models\Transaksi;

class Layanan extends Model
{
    protected $table = "table_layanan";

    public $timestamps = false;
    protected $fillable = ['nama_layanan', 'deskripsi', 'harga_satuan'];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'layanan', 'nama_layanan');
    }
}