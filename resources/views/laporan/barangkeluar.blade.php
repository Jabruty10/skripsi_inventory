@extends('layouts.app')

@section('title', 'Laporan Barang Keluar')

@section('content')
<div class="container-fluid px-4">
    <p class="breadcrumb-custom">
        <span class="fs-4"><a>Laporan Barang Keluar</a></span>
    </p>
    <div class="card">
        <div class="card-body">
            <!-- Tombol cetak PDF -->
            <a href="{{ route('laporan.barangkeluar.pdf', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}" target="_blank" class="btn btn-primary mb-3">
                Download PDF
            </a>

            <!-- Form filter tanggal -->
            <form action="{{ route('laporan.barangkeluar.index') }}" method="GET" class="mb-4 row g-2 align-items-end">
                <div class="col-md-3">
                    <label for="start_date" class="form-label">Dari Tanggal:</label>
                    <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}" required>
                </div>
                <div class="col-md-3">
                    <label for="end_date" class="form-label">Sampai Tanggal:</label>
                    <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}" required>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-success">Filter</button>
                </div>
            </form>

            <!-- Tabel Laporan -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>NO</th>
                            <th>NAMA BARANG</th>
                            <th>PEMBELI</th>
                            <th>HARGA JUAL</th>
                            <th>TGL KELUAR</th>
                            <th>JUMLAH</th>
                            <th>TOTAL HARGA</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalHargaKeseluruhan = 0;
                            $totalQty = 0;
                        @endphp
                        @foreach($barangKeluar as $data)
                            @php
                                $subtotal = $data->harga_jual * $data->qty;
                                $totalHargaKeseluruhan += $subtotal;
                                $totalQty += $data->qty;
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-start">{{ optional($data->barang)->namabarang ?? 'Barang tidak ditemukan' }}</td>
                                <td class="text-start">{{ optional($data->pembeli)->namapembeli ?? 'Tidak ada pembeli' }}</td>
                                <td class="text-center">Rp {{ number_format($data->harga_jual, 0, ',', '.') }}</td>
                                <td>{{ date('d-m-Y H:i:s', strtotime($data->tglkeluar)) }}</td>
                                <td class="text-center">{{ $data->qty }}</td>
                                <td class="text-center">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="5" class="text-end">TOTAL</th>
                            <th class="text-center">{{ $totalQty }}</th>
                            <th class="text-center">Rp {{ number_format($totalHargaKeseluruhan, 0, ',', '.') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
