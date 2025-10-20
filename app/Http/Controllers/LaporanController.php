<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // join berdasarkan nama_layanan (karena table_transaksi.layanan menyimpan nama)
        $query = DB::table('table_transaksi')
            ->leftJoin('table_layanan', 'table_transaksi.layanan', '=', 'table_layanan.nama_layanan')
            ->select('table_transaksi.*', 'table_layanan.nama_layanan as layanan_nama')
            ->orderBy('table_transaksi.created_at', 'desc');

        if ($request->filled('keterangan')) {
            $query->where('table_transaksi.keterangan', $request->keterangan);
        }

        $laporan = $query->get();

        return view('laporan.laporan', compact('laporan'));
    }
}