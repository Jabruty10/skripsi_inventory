@extends('layouts.app')

@section('title', 'Laporan Data Barang')

@section('content')
<div class="container-fluid px-4">
<p class="breadcrumb-custom">
        <span class="fs-4"><a>Laporan Data Barang</a></span>
    </p>
    <div class="card">
        <div class="card-body">
        <a href="{{ route('laporan.barang.pdf') }}" target="_blank" class="btn btn-primary mb-3">Cetak PDF</a>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>N0</th>
                        <th>NAMA BARANG</th>
                        <th>DESKRIPSI</th>
                        <th>SATUAN</th>
                        <th>STOCK</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barangs as $barang)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $barang->namabarang }}</td>
                            <td>{{ $barang->deskripsi }}</td>
                            <td>{{ $barang->satuan }}</td>
                            <td>{{ $barang->stock }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
