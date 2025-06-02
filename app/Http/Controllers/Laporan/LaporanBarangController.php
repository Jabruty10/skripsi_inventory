<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Databarang;

class LaporanBarangController extends Controller
{
    public function index()
    {
        $barangs = Databarang::all();
        return view('laporan.barang', compact('barangs'));
    }

    public function cetakPDF()
    {
        $barangs = Databarang::all();
        $pdf = Pdf::loadView('laporan.barang_pdf', compact('barangs'));
        return $pdf->download('laporan-barang.pdf');
    }
}

