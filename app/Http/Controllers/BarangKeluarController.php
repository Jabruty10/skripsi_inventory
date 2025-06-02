<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Barangkeluar;
use App\Models\Databarang;
use App\Models\Datapembeli;
use App\Models\Barangmasuk;

class BarangKeluarController extends Controller
{
    // Menampilkan data barang keluar
    public function index()
    {
        $barangKeluar = Barangkeluar::with(['barang', 'pembeli'])->orderBy('idbarangkeluar', 'desc')->get();
        $barangs = Databarang::all();
        $pembelis = Datapembeli::all();

        return view('barangkeluar', compact('barangKeluar', 'barangs', 'pembelis'));
    }

    // Menyimpan data barang keluar
    public function store(Request $request)
    {
        $request->validate([
            'kodebarang'    => 'required|array',
            'kodebarang.*'  => 'required|exists:barangs,kodebarang',

            'idpembeli'     => 'required|exists:pembeli,idpembeli',

            'qty'           => 'required|array',
            'qty.*'         => 'required|integer|min:1',
        ]);

        $jumlah = count($request->kodebarang);
        $idpembeli = $request->idpembeli;

        for ($i = 0; $i < $jumlah; $i++) {
            $kode  = $request->kodebarang[$i];
            $qty   = $request->qty[$i];
        
            $barang  = Databarang::where('kodebarang', $kode)->first();
            $pembeli = Datapembeli::find($idpembeli);
        
            if (!$barang || !$pembeli) {
                return redirect()->back()->with('warning', "Barang atau pembeli tidak valid pada baris ke-" . ($i + 1));
            }
        
            if ($barang->stock < $qty) {
                return redirect()->back()->with('warning', "Stok barang tidak cukup untuk {$barang->namabarang} pada baris ke-" . ($i + 1));
            }
        
            $hargaJual = DB::table('barang_masuk')
                ->where('kodebarang', $kode)
                ->orderBy('tglmasuk', 'desc')
                ->value('harga_jual');
        
            Barangkeluar::create([
                'kodebarang' => $kode,
                'namabarang' => $barang->namabarang,
                'idpembeli'  => $idpembeli,
                'harga_jual' => $hargaJual ?? 0,
                'qty'        => $qty,
                'tglkeluar'  => now(),
            ]);
        
            $barang->decrement('stock', $qty);
        }
        
        return redirect()->route('barangkeluar.index')->with('success', 'Barang keluar berhasil ditambahkan.');
    }

    // Menghapus data barang keluar dan mengembalikan stok
    public function destroy($id)
    {
        $barangKeluar = Barangkeluar::findOrFail($id);

        $barang = Databarang::where('kodebarang', $barangKeluar->kodebarang)->first();
        if ($barang) {
            $barang->increment('stock', $barangKeluar->qty);
        }

        $barangKeluar->delete();

        return redirect()->route('barangkeluar.index')->with('success', 'Data berhasil dihapus.');
    }

    public function getNamaBarang($kodebarang)
{
    $barang = Databarang::where('kodebarang', $kodebarang)->first();
    $barangMasukTerbaru = Barangmasuk::where('kodebarang', $kodebarang)
        ->orderBy('tglmasuk', 'desc') // ambil yang paling baru
        ->first();

    return response()->json([
        'namabarang' => $barang?->namabarang ?? '',
        'harga_jual' => $barangMasukTerbaru?->harga_jual ?? 0
    ]);
}

}
