<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Databarang;
use App\Models\Barangmasuk;
use App\Models\Barangkeluar;
use PDF;

class LaporanController extends Controller
{
    public function dataBarang()
    {
        $data = Databarang::all();
        return view('laporan.data-barang', compact('data'));
    }

    public function barangMasuk(Request $request)
    {
        $tanggalAwal = $request->tanggal_awal;
        $tanggalAkhir = $request->tanggal_akhir;

        $query = Barangmasuk::query();
        if ($tanggalAwal && $tanggalAkhir) {
            $query->whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir]);
        }

        $data = $query->get();
        return view('laporan.barang-masuk', compact('data', 'tanggalAwal', 'tanggalAkhir'));
    }

    public function barangKeluar(Request $request)
    {
        $tanggalAwal = $request->tanggal_awal;
        $tanggalAkhir = $request->tanggal_akhir;

        $query = Barangkeluar::query();
        if ($tanggalAwal && $tanggalAkhir) {
            $query->whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir]);
        }

        $data = $query->get();
        return view('laporan.barang-keluar', compact('data', 'tanggalAwal', 'tanggalAkhir'));
    }

    public function barangMasukPdf(Request $request)
    {
        $data = Barangmasuk::whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir])->get();
        $pdf = PDF::loadView('laporan.export.barang-masuk-pdf', compact('data'));
        return $pdf->download('laporan_barang_masuk.pdf');
    }
    public function barangKeluarPdf(Request $request)
    {
        $data = Barangkeluar::whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir])->get();
        $pdf = PDF::loadView('laporan.export.barang-keluar-pdf', compact('data'));
        return $pdf->download('laporan_barang_keluar.pdf');
    }
}
