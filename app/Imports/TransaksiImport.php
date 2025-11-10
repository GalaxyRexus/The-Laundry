<?php

namespace App\Imports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\ToModel;

class TransaksiImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Transaksi([
            'created_at' => $row['created_at'],
            'layanan' => $row['layanan'],
            'berat' => $row['berat'],
            'nama_pelanggan' => $row['nama_pelanggan'],
            'keterangan' => $row['keterangan'],
        ]);
    }
}
