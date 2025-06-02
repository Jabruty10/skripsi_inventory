@extends('layouts.app')

@section('title', 'Laporan Barang Keluar')

@section('content')
<div class="container-fluid px-4">
    <p class="breadcrumb-custom">
        <span class="fs-4"><a>Laporan Barang Keluar</a></span>
    </p>
    <div class="card">
        <div class="card-body">
        <a href="{{ route('laporan.barangkeluar.pdf', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}" target="_blank" class="btn btn-primary mb-3">
            Cetak PDF
        </a>

        <form action="{{ route('laporan.barangkeluar.index') }}" method="GET" class="mb-4">
        <label>Dari Tanggal:</label>
        <input type="date" name="start_date" value="{{ request('start_date') }}" required>

        <label>Sampai Tanggal:</label>
        <input type="date" name="end_date" value="{{ request('end_date') }}" required>

        <button type="submit">Filter</button>
        </form>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>N0</th>
                        <th>NAMA BARANG</th>
                        <th>PEMBELI</th>
                        <th>HARGA JUAL</th>
                        <th>TGL KELUAR</th>
                        <th>JUMLAH</th>
                    </tr>
                </thead>
                <tbody>
                @php
                    $totalHarga = 0;
                @endphp

                @foreach($barangKeluar as $data)
                    @php
                        $subtotal = $data->harga_jual* $data->qty;
                        $totalHarga += $subtotal;
                    @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ optional($data->barang)->namabarang ?? 'Barang tidak ditemukan' }}</td>
                            <td>{{ optional($data->pembeli)->namapembeli ?? 'Tidak ada pembeli' }}</td>
                            <td>Rp {{ number_format($data->harga_jual,0, ',', '.') }}</td>
                            <td>{{ $data->tglkeluar }}</td>
                            <td>{{ $data->qty }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="8" class="text-end text-right">TOTAL HARGA</th>
                        <th>{{ number_format($totalHarga, 0, ',', '.') }}</th>
                     </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
