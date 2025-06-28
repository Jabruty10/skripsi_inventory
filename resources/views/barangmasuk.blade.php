@extends('layouts.app')

@section('title', 'Barang Masuk')

@section('content')
<div class="container-fluid px-4">
    <p class="breadcrumb-custom">
          <span class="fs-4 fw-bold">Barang Masuk</span>
    </p>
    <div class="card mb-4">
        <div class="card-header">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                Tambah Masuk
            </button>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('warning'))
                <div class="alert alert-warning">{{ session('warning') }}</div>
            @endif

            <table id="datatablesSimple" class="table table-bordered">
                <thead>
                    <tr>
                        <th>KODE BARANG</th>
                        <th>NAMA BARANG</th>
                        <th>SUPPLIER</th>
                        <th>SATUAN</th>
                        <th>DESKRIPSI</th>
                        <th>HARGA BELI</th>
                        <th>HARGA JUAL</th>
                        <th>TGL MASUK</th>
                        <th>JUMLAH</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($barangMasuk as $data)
                    <tr>
                        <td>{{ optional($data->barang)->kodebarang ?? 'Barang tidak ditemukan' }}</td>
                        <td>{{ $data->namabarang }}</td>
                        <td>{{ optional($data->supplier)->namasupplier ?? 'Tidak ada supplier' }}</td>
                        <td>{{ $data->satuan }}</td>
                        <td>{{ $data->deskripsi }}</td>
                        <td>Rp {{ number_format($data->harga_beli, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($data->harga_jual, 0, ',', '.') }}</td>
                        <td>{{ $data->tglmasuk }}</td>
                        <td>{{ $data->qty }}</td>
                        <td>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{ $data->idbarangmasuk }}">
                                Hapus
                            </button>
                        </td>
                    </tr>

                    <!-- Modal Delete -->
                    <div class="modal fade" id="delete{{ $data->idbarangmasuk }}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="post" action="{{ route('barangmasuk.destroy', $data->idbarangmasuk) }}">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-header">
                                        <h4 class="modal-title">Hapus Barang</h4>
                                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        @if ($data->barang)
                                            Apakah anda yakin ingin menghapus <strong>{{ $data->namabarang }}</strong>?
                                        @else
                                            Barang tidak ditemukan
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Barang Masuk -->
<div class="modal fade" id="modalTambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('barangmasuk.store') }}">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Barang Masuk</h4>
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <label for="suppliernya">Nama Supplier</label>
                    <select name="idsupplier" id="supplier" class="form-control select2" required>
                        <option value="">--pilih supplier--</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->idsupplier }}">{{ $supplier->namasupplier }}</option>
                        @endforeach
                    </select>

                    <label for="kodebarang" class="mt-3">Kode Barang</label>
                    <select name="kodebarang" id="kodebarang" class="form-control select2" required>
                        <option value="">--pilih kode barang--</option>
                        @foreach($barangs as $barang)
                            <option value="{{ $barang->kodebarang }}">{{ $barang->kodebarang }} - {{ $barang->namabarang }}</option>
                        @endforeach
                    </select>

                    <label for="harga_beli" class="mt-3">Harga Beli</label>
                    <input type="number" step="0.01" id="harga_beli" name="harga_beli" class="form-control" required>

                    <label for="harga_jual" class="mt-3">Harga Jual</label>
                    <input type="number" step="0.01" id="harga_jual" name="harga_jual" class="form-control" required>

                    <label for="qty" class="mt-3">Jumlah</label>
                    <input type="number" id="qty" name="qty" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Select2 & jQuery -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function () {
        // Trigger Select2 ketika modal terbuka
        $('#modalTambah').on('shown.bs.modal', function () {
        $('#supplier').select2({
    dropdownParent: $('#modalTambah'),
    placeholder: "--pilih supplier--",
    allowClear: true,
    width: '100%'
});
            $('#kodebarang').select2({
                dropdownParent: $('#modalTambah'), // wajib agar Select2 tidak tertutup modal
                placeholder: "--pilih kode barang--",
                allowClear: true,
                width: '100%'
            });
        });
    });
</script>
@endsection

