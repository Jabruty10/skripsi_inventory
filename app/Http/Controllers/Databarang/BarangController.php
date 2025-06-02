<?php

namespace App\Http\Controllers\Databarang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Databarang;
use App\Models\Kategori;
use App\Models\Barangmasuk;

class BarangController extends Controller
{
    public function index()
{
    $barangs = Databarang::with('kategori')->get();
    $kategoris = Kategori::all();

    return view('databarang.barang', compact('barangs', 'kategoris'));
}


    public function store(Request $request)
    {
        $request->validate([
            'kodebarang' => 'required|unique:barangs,kodebarang'.'|string|max:10',
            'kodekategori' => 'required|exists:kategori,kodekategori',
            'namabarang' => 'required|string|max:50',
            'deskripsi' => 'required|string|max:50',
            'satuan' => 'required|string|max:50',
        ]);

        Databarang::create([
            'kodebarang' => $request->kodebarang,
            'kodekategori' => $request->kodekategori,
            'namabarang' => $request->namabarang,
            'deskripsi' => $request->deskripsi,
            'satuan' => $request->satuan,
            'stock' => 0 
        ]);

        return redirect()->route('databarang.barang.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function update(Request $request, $kodebarang)
    {
        $barang = Databarang::findOrFail($kodebarang);

        $request->validate([
            'namabarang' => 'required|string|max:50',
            'deskripsi' => 'required|string|max:50',
            'satuan' => 'required|string|max:50',
        ]);

        $barang->update($request->all());

        return redirect()->route('databarang.barang.index')->with('success', 'Data Barang berhasil diupdate.');
    }

    public function destroy($kodebarang)
    {
        $barang = Databarang::findOrFail($kodebarang);
        $barang->delete();

        return redirect()->route('databarang.barang.index')->with('success', 'Data berhasil dihapus.');
    }

    public function getKodeBarang($kodekategori)
    {
        $last = Databarang::where('kodebarang', 'LIKE', $kodekategori . '%')
            ->orderBy('kodebarang', 'desc')
            ->first();

        if ($last) {
            $lastNumber = (int) substr($last->kodebarang, strlen($kodekategori));
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $newKode = $kodekategori . str_pad($newNumber, 2, '0', STR_PAD_LEFT);

        return response()->json(['kodebarang' => $newKode]);
    }

    public function getNamaBarang($kode)
    {
        // Cari barang berdasarkan kodebarang, ambil data harga jual terakhir atau harga jual stok masuk
        $barang = BarangMasuk::where('kodebarang', $kode)->orderBy('created_at', 'desc')->first();

        if ($barang) {
            return response()->json([
                'namabarang' => $barang->namabarang,
                'harga_jual' => $barang->harga_jual,  // pastikan kolom harga_jual di tabel barang_masuk ada
            ]);
        } else {
            return response()->json([], 404);
        }
    }
    
}
