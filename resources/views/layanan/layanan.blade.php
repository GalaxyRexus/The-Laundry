@extends('master')
@section('isi')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">LAYANAN</h1>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahModal">
                <i class="fas fa-plus">
                     Tambah Layanan
                </i>
               
            </button>
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
                                <th>Nama Layanan</th>
                                <th>Deskripsi</th>
                                <th>Harga Satuan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Layanans as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->nama_layanan }}</td>
                                    <td>{{ $item->deskripsi }}</td>
                                    <td>{{ $item->harga_satuan }}</td>
                                    <td>
                                        <button type="button" data-toggle="modal" data-target="#editModal{{ $item->id }}"
                                            class="btn btn-sm btn-warning">Edit</button>
                                        <form id="delete-form-{{ $item->id }}" action="/layanan/delete/{{ $item->id }}"
                                            method="POST" style="display: inline;">
                                            @csrf
                                            <button type="button" class="btn btn-sm btn-danger"
                                                onclick="confirmDelete({{ $item->id }})">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <!--Edit-Modal-->
                                <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Data</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="/layanan/update/{{ $item->id }}" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>Nama Layanan</label>
                                                        <input type="text" class="form-control" name="nama_layanan"
                                                            value="{{ $item->nama_layanan }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Deskripsi</label>
                                                        <textarea name="deskripsi"
                                                            class="form-control">{{ $item->deskripsi }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Harga Satuan (per kg)</label>
                                                        <div class="input-group">
                                                            <input type="number" class="form-control" name="harga_satuan"
                                                                value="{{ $item->harga_satuan }}">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">Kg</span>
                                                            </div>
                                                        </div>
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
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/layanan/store" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Layanan</label>
                            <input type="text" class="form-control" name="nama_layanan" id="layanan"
                                aria-describedby="emailHelp" required>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea type="text-area" name="deskripsi" class="form-control" id="deskripsi"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga Satuan (per kg)</label>
                            <div class="input-group">
                                <input type="number" class="form-control" aria-label="Kg" name="harga_satuan"
                                    placeholder="Masukkan Harga Satuan">
                                <div class="input-group-append">
                                    <span class="input-group-text">Kg</span>
                                </div>
                            </div>
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
// ...existing code...
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
    $(document).ready(function() {
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
// ...existing code...

@endsection