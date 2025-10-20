@extends('master')
@section('isi')
    <div class="content">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            </div>
            <!-- Content Row -->
            <div class="row">
                <!-- Total Transaksi Card -->
                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                       Total Transaksi</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalTransaksi }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Layanan Card -->
                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Jumlah Layanan</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Rp{{$totalPendapatan}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transactions Table -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Transaksi Terbaru</h6>
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
                                @foreach ($Transaksis as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                        <td>{{ $item->layanan }}</td>
                                        <td>{{ $item->berat }} Kg</td>
                                        <td>{{ $item->nama_pelanggan }}</td>
                                        <td>
                                            <span class="badge badge-{{ $item->keterangan == 'Selesai' ? 'success' : ($item->keterangan == 'Proses' ? 'warning' : 'info') }}">
                                                {{ $item->keterangan }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
<div class="row">
                <div class="col-xl-12 col-lg-12 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Transaksi 7 Hari Terakhir</h6>
                        </div>
                        <div class="card-body">
                            <div style="position: relative; height: 300px; width: 100%;">
                                <canvas id="transactionsChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#dataTable').DataTable({
        "order": [[0, "desc"]]
    });
});
</script>

<script>
    // Data dari controller (format JSON langsung, bukan base64)
    var chartLabels = {!! json_encode($chartLabels) !!};
    var chartData = {!! json_encode($chartData) !!};

    // Debug: cek apakah data ada
    console.log('Chart Labels:', chartLabels);
    console.log('Chart Data:', chartData);

    // Tunggu DOM selesai loading
    document.addEventListener('DOMContentLoaded', function() {
        var canvas = document.getElementById('transactionsChart');
        
        if (!canvas) {
            console.error('Canvas element tidak ditemukan');
            return;
        }

        var ctx = canvas.getContext('2d');
        
        // Destroy chart sebelumnya jika ada
        if (window.transactionsChartInstance) {
            window.transactionsChartInstance.destroy();
        }

        // Buat chart baru
        window.transactionsChartInstance = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Jumlah Transaksi',
                    data: chartData,
                    backgroundColor: 'rgba(78, 115, 223, 0.7)',
                    borderColor: 'rgba(78, 115, 223, 1)',
                    borderWidth: 2,
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                }
            }
        });
    });
</script>
@endsection