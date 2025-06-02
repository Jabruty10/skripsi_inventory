<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barangmasuk;
use App\Models\Databarang;
use App\Models\Datasupplier;

class BarangMasukController extends Controller
{
    public function index()
    {
        $barangMasuk = Barangmasuk::with(['barang', 'supplier'])->orderBy('idbarangmasuk', 'desc')->get();
        $barangs = Databarang::all();
        $suppliers = Datasupplier::all();

        return view('barangmasuk', compact('barangMasuk', 'barangs', 'suppliers'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'kodebarang' => 'required|string|exists:barangs,kodebarang',
            'idsupplier' => 'required|integer|exists:supplier,idsupplier',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'qty' => 'required|integer|min:1',
        ]);

        $barang = Databarang::findOrFail($request->kodebarang);        

        Barangmasuk::create([
            'kodebarang' => $request->kodebarang,
            'namabarang' => $barang->namabarang,
            'satuan' => $barang->satuan,
            'deskripsi' => $barang->deskripsi,
            'idsupplier' => $request->idsupplier,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'qty' => $request->qty,
            'tglmasuk' => now(),
        ]);

        $barang->stock += $request->qty;
        $barang->save();

        return redirect()->route('barangmasuk.index')->with('success', 'Data barang masuk berhasil disimpan.');
}
    public function destroy($kodebarang)
    {
        $barangMasuk = Barangmasuk::findOrFail($kodebarang);

        $barang = Databarang::find($barangMasuk->kodebarang);

        if ($barang) {
            $barang->stock -= $barangMasuk->qty;
            $barang->save();
        }

        $barangMasuk->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

}
