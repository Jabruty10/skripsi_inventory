@extends('layouts.app')

@section('title', 'Laporan Barang Masuk')

@section('content')
<div class="container-fluid px-4">
    <p class="breadcrumb-custom">
        <span class="fs-4"><a>Laporan Barang Masuk</a></span>
    </p>
    <div class="card">
        <div class="card-body">
            <a href="{{ route('laporan.barangmasuk.pdf', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}" target="_blank" class="btn btn-primary mb-3">
                Cetak PDF
            </a>

            <form action="{{ route('laporan.barangmasuk.index') }}" method="GET" class="mb-4">
                <label>Dari Tanggal:</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}" required>

                <label>Sampai Tanggal:</label>
                <input type="date" name="end_date" value="{{ request('end_date') }}" required>

                <button type="submit">Filter</button>
            </form>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NAMA BARANG</th>
                        <th>SUPPLIER</th>
                        <th>SATUAN</th>
                        <th>DESKRIPSI</th>
                        <th>HARGA BELI</th>
                        <th>HARGA JUAl</th>
                        <th>TGL MASUK</th>
                        <th>JUMLAH</th>
                        <th>LABA</th>
                    </tr>
                </thead>
                <tbody>
                @php
                    $totalHarga = 0;
                    $totalLaba = 0;
                @endphp

                @foreach($barangMasuk as $data)
                    @php
                        $subtotal = $data->harga_beli * $data->qty;
                        $laba = ($data->harga_jual - $data->harga_beli) * $data->qty;
                        $totalHarga += $subtotal;
                        $totalLaba += $laba;
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ optional($data->barang)->namabarang ?? 'Barang tidak ditemukan' }}</td>
                        <td>{{ optional($data->supplier)->namasupplier ?? 'Tidak ada supplier' }}</td>
                        <td>{{ $data->satuan }}</td>
                        <td>{{ $data->deskripsi }}</td>
                        <td>Rp {{ number_format($data->harga_beli, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($data->harga_jual, 0, ',', '.') }}</td>
                        <td>{{ $data->tglmasuk }}</td>
                        <td>{{ $data->qty }}</td>
                        <td>Rp {{ number_format($laba, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="8" class="text-end">Total Harga</th>
                        <th>{{ number_format($totalHarga, 0, ',', '.') }}</th>
                        <th>{{ number_format($totalLaba, 0, ',', '.') }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
