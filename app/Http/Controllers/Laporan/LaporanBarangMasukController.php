<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Barangmasuk;

class LaporanBarangMasukController extends Controller
{
   public function index(Request $request)
{
    $query = BarangMasuk::with(['barang', 'supplier']);

    if ($request->start_date && $request->end_date) {
        $query->whereBetween('tglmasuk', [$request->start_date, $request->end_date]);
    }

    if ($request->nama_barang) {
        $query->whereHas('barang', function ($q) use ($request) {
            $q->where('namabarang', 'like', '%' . $request->nama_barang . '%');
        });
    }

    if ($request->supplier) {
        $query->whereHas('supplier', function ($q) use ($request) {
            $q->where('namasupplier', 'like', '%' . $request->supplier . '%');
        });
    }

    $barangMasuk = $query->orderBy('tglmasuk', 'desc')->get();

    return view('laporan.barangmasuk.index', compact('barangMasuk'));
}


    public function cetakPDF(Request $request)
{
    $query = Barangmasuk::with(['barang', 'supplier']);

    if ($request->filled('start_date') && $request->filled('end_date')) {
        $query->whereBetween('tglmasuk', [$request->start_date, $request->end_date]);
    }

    $barangMasuk = $query->get();

    // Hitung total harga dan laba
    $totalHarga = 0;
    $totalLaba = 0;

    foreach ($barangMasuk as $data) {
        $totalHarga += $data->harga_beli * $data->qty;
        $totalLaba += ($data->harga_jual - $data->harga_beli) * $data->qty;
    }

    $start_date = $request->start_date;
    $end_date = $request->end_date;

    return Pdf::loadView('laporan.barangmasuk_pdf', compact('barangMasuk', 'start_date', 'end_date', 'totalHarga', 'totalLaba'))
        ->download('laporan-barang-masuk.pdf');
}


}
