<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Layanan;
use App\Exports\TransaksiExport;
use App\Imports\TransaksiImport;
use Maatwebsite\Excel\Facades\Excel;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $Transaksis = Transaksi::all();
    $Layanans = Layanan::all();
    $keteranganOptions = ['Pending', 'Proses', 'Selesai', 'Diambil'];
    $total_harga = Layanan::where('nama_layanan', $Transaksis->layanan)->value('harga_satuan') * $Transaksis->berat;
    return view('transaksi.transaksi', compact('Transaksis', 'Layanans', 'keteranganOptions', 'total_harga'));
}

public function print($id)
{
    $transaksi = Transaksi::find($id);
    $total_harga = Layanan::where('nama_layanan', $transaksi->layanan)->value('harga_satuan') * $transaksi->berat;
    return view('transaksi.cetakstr', compact('transaksi', 'total_harga'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function export()
    {
        return Excel::download(new TransaksiExport, 'transaksi.xlsx');
    }
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        Excel::import(new TransaksiImport, $request->file('file')->store('temp'));
        return redirect('/transaksi')->with('success', 'Data berhasil diimport!');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Transaksi::create([
            'created_at' => $request->created_at,
            'layanan' => $request->layanan,
            'berat' => $request->berat,
            'nama_pelanggan' => $request->nama_pelanggan,
            'keterangan' => $request->keterangan,
        ]);
        return redirect('/transaksi')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $transaksi = Transaksi::find($id);
        $transaksi->created_at = $request->created_at;
        $transaksi->layanan = $request->layanan;
        $transaksi->berat = $request->berat;
        $transaksi->nama_pelanggan = $request->nama_pelanggan;
        $transaksi->keterangan = $request->keterangan;
        $transaksi->save();
        return redirect('/transaksi')->with('success','Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleted = Transaksi::where('id', $id)->delete();
        return redirect('/transaksi')->with('success','Data berhasil dihapus!');
    }
}
