
@extends('master')
@section('isi')
    <div class="container">
        <div id="content">
            <div class="container-fluid">

                <!-- Judul Halaman -->
                <div class="mb-4 d-sm-flex align-items-center justify-content-between">
                    <h1 class="mb-0 text-gray-800 h3">LAPORAN TRANSAKSI</h1>
                </div>

                <!-- Filter -->
                <div class="mb-4 shadow card">
                    <div class="py-3 card-header">
                        <h6 class="m-0 font-weight-bold">Filter Laporan</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/laporan') }}" method="GET" class="form-inline">
                            <label for="keterangan" class="mr-2 font-weight-bold">Pilih Keterangan:</label>
                            <select name="keterangan" id="keterangan" class="form-control mr-2">
                                <option value="">-- Semua --</option>
                                <option value="Pending" {{ request('keterangan') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Proses" {{ request('keterangan') == 'Proses' ? 'selected' : '' }}>Proses</option>
                                <option value="Selesai" {{ request('keterangan') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="Diambil" {{ request('keterangan') == 'Diambil' ? 'selected' : '' }}>Diambil</option>
                            </select>
                            <button type="submit" class="btn btn-primary">Tampilkan</button>
                        </form>
                    </div>
                </div>

                <!-- Data Tabel -->
                <div class="mb-4 shadow card">
                    <div class="py-3 card-header">
                        <h6 class="m-0 font-weight-bold">Hasil Laporan</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Layanan</th>
                                        <th>Berat</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($laporan as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                {{ $item->created_at
                                                    ? \Carbon\Carbon::parse($item->created_at)->format('d-m-Y')
                                                    : '-' }}
                                            </td>
                                            <td>{{ $item->layanan_nama ?? $item->layanan }}</td>
                                            <td>{{ $item->berat }}</td>
                                            <td>{{ $item->nama_pelanggan }}</td>
                                            <td>
                                                @php
                                                    $k = $item->keterangan ?? '';
                                                @endphp

                                                @if(in_array($k, ['Diambil','Selesai']))
                                                    <span class="badge badge-success">{{ $k }}</span>
                                                @elseif($k === 'Proses' || $k === 'Pending')
                                                    <span class="badge badge-warning">{{ $k }}</span>
                                                @else
                                                    <span class="badge badge-secondary">{{ $k ?: '-' }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Tidak ada data ditemukan</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection