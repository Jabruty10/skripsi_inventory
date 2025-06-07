@extends('layouts.app')

@section('title', 'Laporan Data Barang')

@section('content')
<div class="container-fluid px-4">
    <p class="breadcrumb-custom">
        <span class="fs-4"><a>Laporan Data Barang</a></span>
    </p>

    <div class="card mb-4">
        <div class="card-header">
            <a href="{{ route('laporan.barang.pdf') }}" target="_blank" class="btn btn-primary">
                Cetak PDF
            </a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('warning'))
                <div class="alert alert-warning">{{ session('warning') }}</div>
            @endif

            <div class="table-responsive">
                <table id="datatablesSimple" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>KATEGORI</th>
                            <th>NAMA BARANG</th>
                            <th>DESKRIPSI</th>
                            <th>SATUAN</th>
                            <th>STOCK</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($barangs as $barang)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $barang->kategori->namakategori }}</td>
                                <td>{{ $barang->namabarang }}</td>
                                <td>{{ $barang->deskripsi }}</td>
                                <td>{{ $barang->satuan }}</td>
                                <td>{{ $barang->stock }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data barang.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
