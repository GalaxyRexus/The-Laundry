<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Layanan;

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
    
    return view('transaksi.transaksi', compact('Transaksis', 'Layanans', 'keteranganOptions'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
