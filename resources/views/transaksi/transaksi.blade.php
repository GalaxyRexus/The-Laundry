@extends('master')
@section('isi')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">TRANSAKSI</h1>
            <div>
                <a href="/transaksi/export" class="btn btn-success mr-2">
                    <i class="fas fa-file-excel"></i> Export Excel
                </a>

                <button type="button" class="btn btn-info mr-2" data-toggle="modal" data-target="#importModal">
                    <i class="fas fa-file-import"></i> Import Excel
                </button>

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahModal">
                    <i class="fas fa-plus"></i> Tambah Transaksi
                </button>
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
                                <th>Total Harga</th>
                                <th>Nama Pelanggan</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Transaksis as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                    <td>{{ $item->layanan }}</td>
                                    <td>Rp{{ $item->total_harga }}</td>
                                    <td>{{ $item->nama_pelanggan }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>
                                        <button type="button" data-toggle="modal" data-target="#editModal{{ $item->id }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <form id="delete-form-{{ $item->id }}" action="/transaksi/delete/{{ $item->id }}"
                                            method="POST" style="display: inline;">
                                            @csrf
                                            <button type="button" class="btn btn-sm btn-danger"
                                                onclick="confirmDelete({{ $item->id }})">
                                                <i class="fas fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                        <a href="{{ route('transaksi.print', $item->id) }}" target="_blank"
                                            class="btn btn-sm btn-success">
                                            <i class="fas fa-print"></i>
                                        </a>
                                    </td>
                                </tr>

                                <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="/transaksi/import" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Import Layanan (Excel)</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Pastikan File Excel Memiliki Kolom: <strong>nama_layanan, deskripsi,
                                                            harga_satuan</strong></p>
                                                    <div class="form-group">
                                                        <input type="file" name="file" accept=".xlsx,.xls,.csv" required
                                                            class="form-control-file">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Import</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

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

    <!--Tambah-Modal-->
    <div class="modal fade" id="tambahModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/transaksi/store" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Tanggal Transaksi</label>
                            <div class="input-group">
                                <input type="date" class="form-control" name="created_at" required>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Layanan</label>
                            <select class="custom-select" name="layanan" required>
                                <option value="">--Pilih--</option>
                                @foreach ($Layanans as $layanan)
                                    <option value="{{ $layanan->nama_layanan }}">{{ $layanan->nama_layanan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Berat</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="berat" step="0.01" required>
                                <div class="input-group-append">
                                    <span class="input-group-text">Kg</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nama Pelanggan</label>
                            <input type="text" class="form-control" name="nama_pelanggan" required>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <select class="form-control" name="keterangan">
                                <option value="Pending" {{ $item->keterangan == 'Pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="Proses" {{ $item->keterangan == 'Proses' ? 'selected' : '' }}>Proses</option>
                                <option value="Selesai" {{ $item->keterangan == 'Selesai' ? 'selected' : '' }}>Selesai
                                </option>
                                <option value="Diambil" {{ $item->keterangan == 'Diambil' ? 'selected' : '' }}>Diambil
                                </option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        @if(session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 1800
                });
            </script>
        @endif

        <script>
            $(document).ready(function () {
                $('#dataTable').DataTable();
            });

            function confirmDelete(id) {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + id).submit();
                    }
                });
            }
        </script>
    @endsection

@endsection