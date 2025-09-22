@extends('master')
@section('isi')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">TRANSAKSI</h1>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Tambah Layanan
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
                                <th>Tanggal Transaki</th>
                                <th>Layanan</th>
                                <th>Berat</th>
                                <th>Nama Pelanggan</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>1992/06/21</td>
                                <td>Cuci & Setrika</td>
                                <td>5 kg</td>
                                <td>Bimlemk</td>
                                <td>Lagi Dijempumt</td>
                                <td><a class="btn btn-sm btn-warning">Edit</a>
                                    <a class="btn btn-sm btn-danger">Hapus</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <form>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Transaksi</label>
                                <div class="input-group">
                                    <input type="date" class="form-control" aria-label="Tanggal"
                                        placeholder="Masukkan Tanggal Transaksi">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                             <div class="form-group">
                                <label for="exampleFormControlSelect1">Layanan</label>
                                <select class="custom-select" id="exampleFormControlSelect1">
                                    <option selected>--Pilih--</option>
                                    <option>Cuci Kering</option>
                                    <option>Setrika</option>
                                    <option>Cuci Basah</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="harga">Berat</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" aria-label="Kg" placeholder="Masukkan Berat">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Kg</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Pelanggan</label>
                                <input type="text" class="form-control" id="pelanggan" aria-describedby="emailHelp"
                                    required>

                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Keterangan</label>
                                <select class="form-control" id="exampleFormControlSelect1">
                                    <option>Proses</option>
                                    <option>Selesai</option>
                                </select>
                            </div>
                        </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection