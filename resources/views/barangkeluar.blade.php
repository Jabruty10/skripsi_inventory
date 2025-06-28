@extends('layouts.app')

@section('title', 'Barang Keluar')

@section('content')
<div class="container-fluid px-4">
    <p class="breadcrumb-custom">
          <span class="fs-4 fw-bold">Barang Keluar</span>
    </p>

    <!-- ======================= FORM INPUT ======================= -->
    <div class="card">
        <div class="card-header">Input Barang Keluar</div>
        <div class="card-body">
            <div class="row mb-3">
                <label for="idpembeli" class="col-sm-2 col-form-label">Nama Pembeli</label>
                <div class="col-sm-10">
                    <select id="idpembeli" class="form-control select2" style="width: 100%;">
                        <option value="">-- pilih pembeli --</option>
                        @foreach ($pembelis as $p)
                            <option value="{{ $p->idpembeli }}">{{ $p->namapembeli }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="kodebarang" class="col-sm-2 col-form-label">Kode Barang</label>
                <div class="col-sm-10">
                    <select id="kodebarang" class="form-control select2" style="width: 100%;" onchange="getBarangDetail()">
                        <option value="">-- pilih Kode Barang --</option>
                        @foreach ($barangs as $b)
                            <option value="{{ $b->kodebarang }}">{{ $b->kodebarang }} - {{ $b->namabarang }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="harga_jual" class="col-sm-2 col-form-label">Harga Jual</label>
                <div class="col-sm-10">
                    <input type="text" id="harga_jual" class="form-control" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <label for="qty" class="col-sm-2 col-form-label">Jumlah</label>
                <div class="col-sm-10">
                    <input type="number" id="qty" class="form-control" min="1">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 text-end">
                    <button class="btn btn-success" onclick="tambahKeKeranjang()">+ Tambah Barang</button>
                </div>
            </div>
        </div>
    </div>
    <br>

    <!-- ======================= KERANJANG ======================= -->
    <div class="card mb-4">
    <div class="card-header">Keranjang Barang</div>
    <div class="card-body">
        <p><strong>Pembeli:</strong> <span id="keranjang-nama-pembeli">-</span></p>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Barang</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="keranjang-table-body">
                    <tr><td colspan="5" class="text-muted text-center">Belum ada barang ditambahkan.</td></tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3">Total</th>
                        <th colspan="2" id="keranjang-total">Rp0</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

    <!-- ======================= SUBMIT FORM ======================= -->
    <form method="POST" action="{{ route('barangkeluar.store') }}" id="formKeranjang">
        @csrf
        <input type="hidden" name="idpembeli" id="form-idpembeli">
        <div id="form-barang-container"></div>
        <div class="text-end mt-3">
            <button type="submit" class="btn btn-primary d-none" id="btn-submit">Submit Semua Barang</button>
        </div>
    </form>
    <br>
    <!-- ======================= TABEL ======================= -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Daftar Barang Keluar</h5>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('warning'))
                <div class="alert alert-warning">{{ session('warning') }}</div>
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
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete{{ $data->idbarangkeluar }}">Hapus</button>
                            </td>
                        </tr>
                        <div class="modal fade" id="delete{{ $data->idbarangkeluar }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('barangkeluar.destroy', $data->idbarangkeluar) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-header">
                                            <h5 class="modal-title">Hapus Barang Keluar</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah yakin ingin menghapus: <strong>{{ $data->namabarang }}</strong>?
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
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#idpembeli').select2({ placeholder: "-- pilih pembeli --", allowClear: true });
        $('#kodebarang').select2({ placeholder: "-- pilih Kode Barang --", allowClear: true });
    });

    let keranjang = [];

    function getBarangDetail() {
        let kode = document.getElementById('kodebarang').value;
        if (kode) {
            fetch(`/get-nama-barang/${kode}`)
                .then(res => res.json())
                .then(data => {
                    if (data && data.harga_jual !== undefined) {
                        document.getElementById('harga_jual').value = `Rp ${parseInt(data.harga_jual).toLocaleString('id-ID')}`;
                    } else {
                        document.getElementById('harga_jual').value = '';
                    }
                }).catch(() => {
                    document.getElementById('harga_jual').value = '';
                });
        } else {
            document.getElementById('harga_jual').value = '';
        }
    }

    function tambahKeKeranjang() {
        const kodebarang = document.getElementById('kodebarang').value;
        const hargaText = document.getElementById('harga_jual').value.replace(/[^0-9]/g, '');
        const harga = parseInt(hargaText);
        const qty = parseInt(document.getElementById('qty').value);
        const idpembeli = document.getElementById('idpembeli').value;
        const namaBarang = document.getElementById('kodebarang').selectedOptions[0].text;

        if (!kodebarang || !qty || qty < 1) return alert("Isi semua field dengan benar");

        keranjang.push({ kodebarang, namaBarang, harga, qty });

        renderKeranjang();
        renderFormInput();
        resetForm();
        document.getElementById('form-idpembeli').value = idpembeli;
        document.getElementById('btn-submit').classList.remove('d-none');
    }

    function renderKeranjang() {
    const tbody = document.getElementById('keranjang-table-body');
    const totalElement = document.getElementById('keranjang-total');
    const pembeliText = document.getElementById('idpembeli').selectedOptions[0]?.text || '-';
    document.getElementById('keranjang-nama-pembeli').textContent = pembeliText;

    tbody.innerHTML = '';
    let total = 0;

    if (keranjang.length === 0) {
        tbody.innerHTML = `<tr><td colspan="5" class="text-muted text-center">Belum ada barang ditambahkan.</td></tr>`;
        totalElement.textContent = 'Rp0';
        return;
    }

    keranjang.forEach((item, index) => {
        const subtotal = item.harga * item.qty;
        total += subtotal;
        tbody.innerHTML += `
            <tr>
                <td>${item.namaBarang}</td>
                <td>Rp${item.harga.toLocaleString('id-ID')}</td>
                <td>${item.qty}</td>
                <td>Rp${subtotal.toLocaleString('id-ID')}</td>
                <td><button onclick="hapusBarang(${index})" class="btn btn-sm btn-danger">x</button></td>
            </tr>
        `;
    });

    totalElement.textContent = `Rp${total.toLocaleString('id-ID')}`;
}


    function renderFormInput() {
        const container = document.getElementById('form-barang-container');
        container.innerHTML = '';
        keranjang.forEach(item => {
            container.innerHTML += `
                <input type="hidden" name="kodebarang[]" value="${item.kodebarang}">
                <input type="hidden" name="qty[]" value="${item.qty}">
            `;
        });
    }

    function resetForm() {
        $('#kodebarang').val(null).trigger('change');
        document.getElementById('harga_jual').value = '';
        document.getElementById('qty').value = '';
    }

    function hapusBarang(index) {
        keranjang.splice(index, 1);
        renderKeranjang();
        renderFormInput();
        if (keranjang.length === 0) {
            document.getElementById('btn-submit').classList.add('d-none');
        }
    }
    
</script>
@endpush