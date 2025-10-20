<?php

namespace App\Exports;

use App\Models\Layanan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LayananExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Layanan::select('nama_layanan', 'deskripsi', 'harga_satuan')->get();
    }
    public function headings(): array
    {
        return [
            'nama_layanan',
            'deskripsi',
            'harga_satuan',
        ];
    }
}
