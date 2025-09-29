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
                <!-- Earnings (Monthly) Card Example -->
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

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Jumlah Layanan</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalLayanan}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                        </div>
                                        <div class="col">
                                            <div class="progress progress-sm mr-2">
                                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%"
                                                    aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Requests Card Example -->
                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Pending Requests</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Transaksi Hari Ini</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Transaki</th>
                                <th>Layanan</th>
                                <th>Berat</th>
                                <th>Nama Pelanggan</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Transaksis as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->layanan }}</td>
                                    <td>{{ $item->berat }}</td>
                                    <td>{{ $item->nama_pelanggan }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                </tr>

                                <!-- Modal Edit untuk setiap item -->
                                <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Data</h5>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="/transaksi/update/{{ $item->id }}" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>Tanggal Transaksi</label>
                                                        <input type="date" name="created_at" class="form-control"
                                                            value="{{ $item->created_at->format('Y-m-d') }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Layanan</label>
                                                        <select class="custom-select" name="layanan">
                                                            @foreach ($Layanans as $layanan)
                                                                <option value="{{ $layanan->nama_layanan }}" {{ $item->layanan == $layanan->nama_layanan ? 'selected' : '' }}>
                                                                    {{ $layanan->nama_layanan }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Berat</label>
                                                        <div class="input-group">
                                                            <input type="number" name="berat" class="form-control"
                                                                value="{{ $item->berat }}">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">Kg</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Nama Pelanggan</label>
                                                        <input type="text" name="nama_pelanggan" class="form-control"
                                                            value="{{ $item->nama_pelanggan }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Keterangan</label>
                                                        <select class="form-control" name="keterangan">
                                                            <option value="Pending" {{ $item->keterangan == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                            <option value="Proses" {{ $item->keterangan == 'Proses' ? 'selected' : '' }}>Proses</option>
                                                            <option value="Selesai" {{ $item->keterangan == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                                            <option value="Diambil" {{ $item->keterangan == 'Diambil' ? 'selected' : '' }}>Diambil</option>
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
    </div>
    @section('scripts')
    <script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
    </script>
@endsection
@endsection