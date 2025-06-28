@extends('layouts.app')

@section('title', 'Data Barang')

@section('content')
            <div class="container-fluid px-4">
                <p class="breadcrumb-custom">
                    <span class="fs-4 fw-bold">Data Barang</a></span>
                      <span class="fs-4 fw-bold">Barang</span>
                </p>
                <div class="card mb-4">
                    <div class="card-header">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                            Tambah Barang
                        </button>
                    </div>
                    <div class="card-body">
                        @foreach ($barangs as $barang)
                            @if ($barang->stock < 1)
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Perhatian!</strong> Stock {{ $barang->namabarang }} Telah Habis
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                        @endforeach

                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if(session('warning'))
                                <div class="alert alert-warning">
                                    {{ session('warning') }}
                                </div>
                            @endif

                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>KODE BARANG</th>
                                    <th>KATEGORI</th>
                                    <th>NAMA BARANG</th>
                                    <th>SATUAN</th>
                                    <th>DESKRIPSI</th>
                                    <th>STOCK</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($barangs as $index => $barang)
                                    <tr>
                                        <td>{{ $barang->kodebarang }}</td>
                                        <td>{{ optional($barang->kategori)->namakategori ?? 'Kategori tidak ditemukan' }}</td>
                                        <td>{{ $barang->namabarang }}</td>
                                        <td>{{ $barang->satuan }}</td>
                                        <td>{{ $barang->deskripsi }}</td>
                                        <td>{{ $barang->stock }}</td>
                                        <td>
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit{{ $barang->kodebarang }}">
                                                Edit
                                            </button>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{ $barang->kodebarang }}">
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="edit{{ $barang->kodebarang }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form method="post" action="{{ route('databarang.barang.update', $barang->kodebarang) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Barang</h4>
                                                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <label for="namabarang">Nama Barang</label>
                                                        <input type="text" name="namabarang" value="{{ $barang->namabarang }}" class="form-control" required>
                                                        <br>
                                                        <label for="satuan">Satuan</label>
                                                        <input type="text" name="satuan" value="{{ $barang->satuan }}" class="form-control" required>
                                                        <br>
                                                        <label for="deskripsi">Deskripsi</label>
                                                        <input type="text" name="deskripsi" value="{{ $barang->deskripsi }}" class="form-control" required>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-warning">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="delete{{ $barang->kodebarang }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form method="post" action="{{ route('databarang.barang.destroy', $barang->kodebarang) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Hapus Barang</h4>
                                                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah anda yakin ingin menghapus <strong>{{ $barang->namabarang }}</strong>?
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

            <!-- Modal Tambah Barang -->
            <div class="modal fade" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('databarang.barang.store') }}">
                            @csrf
                            <div class="modal-header">
                                <h4 class="modal-title">Tambah Barang</h4>
                                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <label for="kodekategori">Nama Kategori</label>
                                <select name="kodekategori" id="kodekategori" class="form-control select2">
                                    <option value="">--pilih kategori--</option>
                                    @foreach ($kategoris as $kat)
                                        <option value="{{ $kat->kodekategori }}">{{ $kat->namakategori }}</option>
                                    @endforeach
                                </select>
                                    
                                <label for="kodebarang" class="mt-3">Kode Barang</label>
                                <input type="text" id="kodebarang" name="kodebarang" class="form-control" readonly>
                                
                                <label for="namabarang" class="mt-3">Nama Barang</label>
                                <input type="text" id="namabarang" name="namabarang" class="form-control" required value="{{ old('namabarang') }}">
                         
                                <label for="merek" class="mt-3">Satuan</label>
                                <input type="text" id="satuan" name="satuan" class="form-control" required value="{{ old('satuan') }}">

                                <label for="deskripsi" class="mt-3">Deskripsi</label>
                                <input type="text" id="deskripsi" name="deskripsi" class="form-control" required value="{{ old('deskripsi') }}">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap Bundle JS (sudah termasuk Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const kategoriSelect = document.querySelector('select[name="kodekategori"]');
                    const kodeBarangInput = document.querySelector('input[name="kodebarang"]');

                    $('#kodekategori').on('change', function () {
                        const kodekategori = this.value;
                        if (kodekategori) {
                            fetch(`/get-kodebarang/${kodekategori}`)
                                .then(res => res.json())
                                .then(data => {
                                    kodeBarangInput.value = data.kodebarang;
                                });
                        } else {
                            kodeBarangInput.value = '';
                        }
                    });

                    // Trigger otomatis saat form load (jika kategori sudah terisi default)
                    if (kategoriSelect.value) {
                        kategoriSelect.dispatchEvent(new Event('change'));
                    }
                });
            </script>


            {{-- Script agar modal terbuka otomatis jika validasi gagal --}}
            @if ($errors->any())
                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        var myModal = new bootstrap.Modal(document.getElementById('myModal'));
                        myModal.show();
                    });
                </script>
            @endif
            <script>
    $(document).ready(function () {
        // Trigger Select2 ketika modal terbuka
        $('#myModal').on('shown.bs.modal', function () {
            $('#kodekategori').select2({
                dropdownParent: $('#myModal'), // wajib agar Select2 tidak tertutup modal
                placeholder: "--pilih kode barang--",
                allowClear: true,
                width: '100%'
            });
        });
    });
</script>



@endsection
