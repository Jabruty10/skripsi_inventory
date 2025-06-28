@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<div class="container-fluid px-4">
    <p class="breadcrumb-custom">
        <span class="fs-4 fw-bold">Beranda</span>
    </p>

    {{-- Card Selamat Datang --}}
    <div class="card mb-4 p-3">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            {{-- Kiri: Avatar + Selamat Datang --}}
            <div class="d-flex align-items-center">
                <div class="rounded-circle bg-dark text-white d-flex justify-content-center align-items-center" style="width: 40px; height: 40px; font-weight: bold;">
                    A
                </div>
                <div class="ms-3">
                    <div class="fw-semibold">Selamat Datang</div>
                    <small class="text-muted">admin</small>
                </div>
            </div>

            {{-- Kanan: Tombol --}}
            <div class="d-flex mt-3 mt-md-0">
                <a href="{{ route('manual.book') }}" class="btn btn-success me-2">
                    Manual Book
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary">
                        <i class="fas fa-sign-out-alt"></i> Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Card Statistik --}}
    <div class="row">
        @php
            $data = [
                ['label' => 'Total Barang', 'link' => 'databarang/barang', 'value' => $totalBarang],
                ['label' => 'Total Barang Masuk', 'link' => 'barang-masuk', 'value' => $totalBarangMasuk],
                ['label' => 'Total Barang Keluar', 'link' => 'barang-keluar', 'value' => $totalBarangKeluar],
                ['label' => 'Total Pembeli', 'link' => 'pembeli', 'value' => $totalPembeli],
            ];
        @endphp

        @foreach ($data as $item)
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-white text-dark border h-100 shadow-sm">
                <div class="card-body">
                    <span class="fw-semibold">{{ $item['label'] }}</span><br>
                    <h3>{{ $item['value'] }}</h3>
                </div>
                <div class="card-footer bg-white border-top d-flex align-items-center justify-content-between">
                    <a class="small text-primary stretched-link" href="{{ url($item['link']) }}">View Details</a>
                    <div class="small text-primary"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
