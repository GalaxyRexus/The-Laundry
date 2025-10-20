<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Layanan;
use Carbon\Carbon;

class BerandaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $days = collect(range(6, 0))->map(fn($i) => Carbon::today()->subDays($i)->format('Y-m-d'));

        $start = Carbon::parse($days->first())->startOfDay();
        $end = Carbon::parse($days->last())->endOfDay();

        // ambil jumlah transaksi per tanggal dalam rentang
        $counts = Transaksi::whereBetween('created_at', [$start, $end])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->groupBy('date')
            ->pluck('total', 'date')
            ->toArray();

        $chartLabels = $days->map(fn($d) => Carbon::parse($d)->format('d M'))->toArray();
        $chartData = $days->map(fn($d) => $counts[$d] ?? 0)->toArray();


        $Transaksis = Transaksi::all();
        $Layanans = Layanan::all();
        $totalLayanan = Layanan::count();
        $totalTransaksi = Transaksi::count();
        $totalPendapatan = Transaksi::join('table_layanan', 'table_transaksi.layanan', '=', 'table_layanan.nama_layanan')
            ->selectRaw('SUM(table_transaksi.berat * table_layanan.harga_satuan) as total_pendapatan')
            ->value('total_pendapatan');

        return view('dashboard.beranda', compact(
            'Transaksis',
            'Layanans',
            'totalLayanan',
            'totalTransaksi',
            'totalPendapatan',
            'chartLabels',
            'chartData'
        ));
        
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
