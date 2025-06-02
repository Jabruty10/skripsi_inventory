<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Barangkeluar;

class LaporanBarangKeluarController extends Controller
{
    public function index(Request $request)
    {
    $query = Barangkeluar::with('barang');

    if ($request->filled('start_date') && $request->filled('end_date')) {
        $query->whereBetween('tglkeluar', [$request->start_date, $request->end_date]);
    }

    $barangKeluar = $query->get();

    return view('laporan.barangkeluar', compact('barangKeluar'));
    }

    public function cetakPDF(Request $request)
{
    $query = Barangkeluar::with(['barang', 'pembeli']);

    $start_date = $request->start_date;
    $end_date = $request->end_date;

    if ($start_date && $end_date) {
        $query->whereBetween('tglkeluar', [$start_date, $end_date]);
    }

    $barangKeluar = $query->get();

    $totalHarga = $barangKeluar->sum(function ($item) {
        return $item->harga_jual * $item->qty;
    });

    $pdf = Pdf::loadView('laporan.barangkeluar_pdf', [
        'barangKeluar' => $barangKeluar,
        'totalHarga' => $totalHarga,
        'start_date' => $start_date,
        'end_date' => $end_date
    ]);

    return $pdf->download('laporan-barang-keluar.pdf');
}

}
