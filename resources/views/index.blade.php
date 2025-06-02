@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<div class="container-fluid px-4">
    <p class="breadcrumb-custom">
        <span class="fs-4"><a>Beranda</a></span>
    </p>
    <div class="row">
        @php
            $data = [
                ['label' => 'Total Barang', 'color' => 'primary', 'link' => 'databarang/barang', 'value' => $totalBarang],
                ['label' => 'Total Barang Masuk', 'color' => 'warning', 'link' => 'barang-masuk', 'value' => $totalBarangMasuk],
                ['label' => 'Total Barang Keluar', 'color' => 'success', 'link' => 'barang-keluar', 'value' => $totalBarangKeluar],
                ['label' => 'Total Pembeli', 'color' => 'danger', 'link' => 'pembeli', 'value' => $totalPembeli],
            ];
        @endphp

        @foreach ($data as $item)
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-{{ $item['color'] }} text-white h-100">
                <div class="card-body">
                    {{ $item['label'] }}<br>
                    <h3>{{ $item['value'] }}</h3>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ url($item['link']) }}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
