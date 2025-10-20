<?php

namespace App\Imports;

use App\Models\Layanan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeaderRow;

class LayananImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Layanan([
            'nama_layanan' => $row['nama_layanan'],
            'deskripsi' => $row['deskripsi'],
            'harga_satuan' => $row['harga_satuan'],
        ]);
    }
}
