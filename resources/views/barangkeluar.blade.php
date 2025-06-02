@extends('layouts.app')

@section('title', 'Barang keluar')

@section('content')
<div class="container-fluid px-4">
    <p class="breadcrumb-custom">
        <span class="fs-4"><a>Barang Keluar</a></span>
    </p>
    <div class="card mb-4">
        <div class="card-header">
            <!-- Button to Open the Modal -->
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                Tambah Keluar
            </button>
        </div>
        <div class="card-body">
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
                        <th>NAMA BARANG</th>
                        <th>PEMBELI</th>
                        <th>HARGA JUAL</th>
                        <th>TGL KELUAR</th>
                        <th>JUMLAH</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($barangKeluar as $data)
                        <tr>
                            <td>{{ optional($data->barang)->kodebarang ?? 'Barang tidak ditemukan' }}</td>
                            <td>{{ $data->namabarang }}</td>
                            <td>{{ optional($data->pembeli)->namapembeli ?? 'Tidak ada pembeli' }}</td>
                            <td>Rp {{ number_format($data->harga_jual, 0, ',', '.') }}</td>
                            <td>{{ $data->tglkeluar }}</td>
                            <td>{{ $data->qty }}</td>
                            <td>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{ $data->idbarangkeluar }}">
                                    Delete
                                </button>
                            </td>
                        </tr>

                        <!-- Modal Delete -->
                        <div class="modal fade" id="delete{{ $data->idbarangkeluar }}" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('barangkeluar.destroy', $data->idbarangkeluar) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteLabel">Hapus Barang Keluar</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @if ($data->barang)
                                                Apakah anda yakin ingin menghapus {{ $data->barang->namabarang }}?
                                            @else
                                                Barang tidak ditemukan
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-danger">Hapus</button>
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

<!-- Modal Tambah Barang Keluar -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('barangkeluar.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">Tambah Barang Keluar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- PILIH PEMBELI -->
                    <label>Nama Pembeli</label>
                    <select name="idpembeli" class="form-control" required>
                        <option value="">--pilih pembeli--</option>
                        @foreach($pembelis as $pembeli)
                            <option value="{{ $pembeli->idpembeli }}">{{ $pembeli->namapembeli }}</option>
                        @endforeach
                    </select>

                    <div id="form-barang-wrapper" class="mt-4">
                        <div class="form-barang mb-3 border-bottom pb-3">
                            <label for="kodebarang">Kode Barang</label>
                            <select name="kodebarang[]" class="form-control kodebarang-select select2" required>
                                <option value="">--pilih kode barang--</option>
                                 @foreach($barangs as $barang)
                                    <option value="{{ $barang->kodebarang }}">{{ $barang->kodebarang }} - {{ $barang->namabarang }}</option>
                                 @endforeach
                             </select>

                            <label for="hargajual" class="mt-3">Harga Jual</label>
                            <input type="text" class="form-control harga-jual-input" readonly>
                            <input type="hidden" name="harga_jual[]" class="harga-jual-hidden">

                            <label class="mt-3">Jumlah</label>
                            <input type="number" name="qty[]" class="form-control" required>

                            <button type="button" class="btn btn-danger btn-sm mt-2 btn-hapus-baris" style="display:none;">Hapus Baris</button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary mt-2" id="tambah-baris">+ Tambah Barang</button>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).on('change', '.kodebarang-select', function () {
        var kode = $(this).val();
        var parentForm = $(this).closest('.form-barang');
        var namabarangInput = parentForm.find('.namabarang-input');
        var hargaJualTampil = parentForm.find('.harga-jual-input'); // tampilan
        var hargaJualHidden = parentForm.find('.harga-jual-hidden'); // input hidden (untuk disubmit)

        if (kode) {
            $.ajax({
                url: '/get-nama-barang/' + kode,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    namabarangInput.val(data.namabarang || '');

                    // Format harga jual ke rupiah
                    let formatted = new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0
                    }).format(data.harga_jual ?? 0);

                    hargaJualTampil.val(formatted);
                    hargaJualHidden.val(data.harga_jual ?? 0);
                },
                error: function () {
                    namabarangInput.val('');
                    hargaJualTampil.val('');
                    hargaJualHidden.val('');
                }
            });
        } else {
            namabarangInput.val('');
            hargaJualTampil.val('');
            hargaJualHidden.val('');
        }
    });
</script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "--pilih kode barang--",
            allowClear: true
        });
    });
</script>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const wrapper = document.getElementById('form-barang-wrapper');
        const tambahBtn = document.getElementById('tambah-baris');

        tambahBtn.addEventListener('click', function () {
            const forms = wrapper.querySelectorAll('.form-barang');
            const newForm = forms[0].cloneNode(true);

            newForm.querySelectorAll('input, select').forEach(function (el) {
                el.value = '';
            });

            newForm.querySelector('.btn-hapus-baris').style.display = 'inline-block';

            wrapper.appendChild(newForm);
        });

        wrapper.addEventListener('click', function (e) {
            if (e.target.classList.contains('btn-hapus-baris')) {
                e.target.closest('.form-barang').remove();
            }
        });
    });
</script>
@endpush
