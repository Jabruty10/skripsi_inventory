@extends('layouts.app')

@section('title', 'Manual Book')

@section('content')
<div class="container px-4">
   <h3 class="my-4 text-center fw-bold text-primary">
    Panduan Penggunaan Sistem Persediaan Stok Barang
    </h3>
    <div class="row justify-content-center">

        {{-- Langkah 1 --}}
        <div class="col-md-6 mb-4">
            <div class="border rounded p-3 shadow-sm">
                <h6 class="bg-primary text-white px-2 py-1 rounded-pill d-inline-block mb-2">Langkah 1</h6>
                <h5 class="text-primary fw-bold">Masuk ke Beranda</h5>
                <ul class="mb-0">
                    <li>Login dengan username dan password.</li>
                    <li>Setelah login berhasil, Anda akan diarahkan ke halaman beranda.</li>
                    <li>Lihat ringkasan total data.</li>
                </ul>
            </div>
        </div>

        {{-- Langkah 2 --}}
        <div class="col-md-6 mb-4">
            <div class="border rounded p-3 shadow-sm">
                <h6 class="bg-primary text-white px-2 py-1 rounded-pill d-inline-block mb-2">Langkah 2</h6>
                <h5 class="text-primary fw-bold">Menambahkan Data Kategori</h5>
                <ul class="mb-0">
                    <li>Pilih menu <strong>Data Barang > Kategori</strong>.</li>
                    <li>Klik tombol <strong>Tambah Kategori</strong>.</li>
                    <li>Isi informasi kategori: kode kategori dan nama kategori.</li>
                    <li>Klik tombol <strong>Submit</strong>.</li>
                </ul>
            </div>
        </div>

        {{-- Langkah 3--}}
        <div class="col-md-6 mb-4">
            <div class="border rounded p-3 shadow-sm">
                <h6 class="bg-primary text-white px-2 py-1 rounded-pill d-inline-block mb-2">Langkah 3</h6>
                <h5 class="text-primary fw-bold">Menambahkan Data Barang</h5>
                <ul class="mb-0">
                    <li>Pilih menu <strong>Data Barang > Barang</strong>.</li>
                    <li>Klik tombol <strong>Tambah Barang</strong>.</li>
                    <li>Isi informasi kategori: nama kategori, kode barang, nama barang, satuan, dan deskripsi.</li>
                    <li>Klik tombol <strong>Submit</strong>.</li>
                </ul>
            </div>
        </div>

        {{-- Langkah 4 --}}
        <div class="col-md-6 mb-4">
            <div class="border rounded p-3 shadow-sm">
                <h6 class="bg-primary text-white px-2 py-1 rounded-pill d-inline-block mb-2">Langkah 4</h6>
                <h5 class="text-primary fw-bold">Mengelola Data Supplier</h5>
                <ul class="mb-0">
                    <li>Pilih menu <strong>Data Supplier</strong>.</li>
                    <li>Klik <strong>Tambah Supplier</strong> untuk menambahkan data supplier.</li>
                    <li>Isi informasi supplier: nama supplier, alamat dan no telpon.</li>
                    <li>Klik tombol <strong>Submit</strong>.</li>
                    <li>Dapat juga <strong>Edit</strong> atau <strong>Hapus</strong> supplier yang sudah ada.</li>
                </ul>
            </div>
        </div>

        {{-- Langkah 5 --}}
        <div class="col-md-6 mb-4">
            <div class="border rounded p-3 shadow-sm">
                <h6 class="bg-primary text-white px-2 py-1 rounded-pill d-inline-block mb-2">Langkah 5</h6>
                <h5 class="text-primary fw-bold">Mengelola Data Pembeli</h5>
                <ul class="mb-0">
                    <li>Pilih menu <strong>Data Pembeli</strong>.</li>
                    <li>Klik <strong>Tambah Pembeli</strong> untuk menambahkan data pembeli.</li>
                    <li>Isi informasi pembeli: nama pembeli, alamat dan no telpon.</li>
                    <li>Klik tombol <strong>Submit</strong>.</li>
                    <li>Dapat juga <strong>Edit</strong> atau <strong>Hapus</strong> pembeli yang sudah ada.</li>
                </ul>
            </div>
        </div>

        {{-- Langkah 6 --}}
        <div class="col-md-6 mb-4">
            <div class="border rounded p-3 shadow-sm">
                <h6 class="bg-primary text-white px-2 py-1 rounded-pill d-inline-block mb-2">Langkah 6</h6>
                <h5 class="text-primary fw-bold">Mencatat Barang Masuk</h5>
                <ul class="mb-0">
                    <li>Pilih menu <strong>Barang Masuk</strong>.</li>
                    <li>Klik tombol <strong>Tambah Barang Masuk</strong>.</li>
                    <li>Pilih nama supplier dan kode barang masukkan harga beli, harga jual dan jumlah barang.</li>
                    <li>Klik tombol <strong>Submit</strong>.</li>
                </ul>
            </div>
        </div>

        {{-- Langkah 7 --}}
        <div class="col-md-6 mb-4">
            <div class="border rounded p-3 shadow-sm">
                <h6 class="bg-primary text-white px-2 py-1 rounded-pill d-inline-block mb-2">Langkah 7</h6>
                <h5 class="text-primary fw-bold">Mencatat Barang Keluar</h5>
                <ul class="mb-0">
                    <li>Pilih menu <strong>Barang Keluar</strong>.</li>
                    <li>Pada Input Barang Keluar pilih nama pembeli dan kode barang.</li>
                    <li>Isi jumlah barang yang keluar.</li>
                    <li>Klik <strong>+ Tambah Barang</strong>.</li>
                    <li>Data masuk pada Keranjang Barang.</li>
                    <li>Klik <strong>Submit Semua Barang</strong> untuk menyimpan ke daftar barang keluar.</li>
                </ul>
            </div>
        </div>

        {{-- Langkah 8 --}}
        <div class="col-md-6 mb-4">
            <div class="border rounded p-3 shadow-sm">
                <h6 class="bg-primary text-white px-2 py-1 rounded-pill d-inline-block mb-2">Langkah 8</h6>
                <h5 class="text-primary fw-bold">Melihat & Mencetak Laporan</h5>
                <ul class="mb-0">
                    <li>Pilih menu <strong>Laporan</strong>.</li>
                    <li>Pilih menu <strong>Laporan Data Barang,Laporan Barang Masuk</strong> atau <strong>Laporan Barang Keluar</strong>.</li>
                    <li>Pilih tanggal atau filter yang diinginkan.</li>
                    <li>Klik tombol <strong>Download PDF</strong>.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
