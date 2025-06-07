<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Barangkeluar;
use App\Models\Databarang;
use App\Models\Datapembeli;
use App\Models\Barangmasuk;

class BarangKeluarController extends Controller
{
    // Menampilkan halaman utama barang keluar
    public function index()
    {
        $barangKeluar = Barangkeluar::with(['barang', 'pembeli'])->orderBy('idbarangkeluar', 'desc')->get();
        $barangs = Databarang::all();
        $pembelis = Datapembeli::all();

        return view('barangkeluar', compact('barangKeluar', 'barangs', 'pembelis'));
    }

    // Menyimpan transaksi barang keluar
    public function store(Request $request)
    {
        $request->validate([
            'kodebarang'    => 'required|array',
            'kodebarang.*'  => 'required|exists:barangs,kodebarang',
            'qty'           => 'required|array',
            'qty.*'         => 'required|integer|min:1',
            'idpembeli'     => 'required|exists:pembeli,idpembeli',
        ]);

        $jumlah    = count($request->kodebarang);
        $idpembeli = $request->idpembeli;

        // Jalankan dalam transaksi DB agar konsisten
        DB::beginTransaction();
        try {
            for ($i = 0; $i < $jumlah; $i++) {
                $kode = $request->kodebarang[$i];
                $qty  = $request->qty[$i];

                $barang  = Databarang::where('kodebarang', $kode)->first();
                $pembeli = Datapembeli::find($idpembeli);

                // Validasi manual jika data tidak ditemukan (harusnya tidak terjadi karena sudah divalidasi sebelumnya)
                if (!$barang || !$pembeli) {
                    DB::rollBack();
                    return redirect()->back()->with('warning', "Barang atau pembeli tidak valid pada baris ke-" . ($i + 1));
                }

                if ($barang->stock < $qty) {
                    DB::rollBack();
                    return redirect()->back()->with('warning', "Stok tidak cukup untuk barang {$barang->namabarang} pada baris ke-" . ($i + 1));
                }

                // Ambil harga jual terbaru dari tabel barang_masuk
                $hargaJual = Barangmasuk::where('kodebarang', $kode)
                    ->orderBy('tglmasuk', 'desc')
                    ->value('harga_jual') ?? 0;

                // Simpan barang keluar
                Barangkeluar::create([
                    'kodebarang' => $kode,
                    'namabarang' => $barang->namabarang,
                    'idpembeli'  => $idpembeli,
                    'harga_jual' => $hargaJual,
                    'qty'        => $qty,
                    'tglkeluar'  => now(),
                ]);

                // Update stok
                $barang->decrement('stock', $qty);
            }

            DB::commit();
            return redirect()->route('barangkeluar.index')->with('success', 'Barang keluar berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('warning', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    // Menghapus data barang keluar dan mengembalikan stok
    public function destroy($id)
    {
        $barangKeluar = Barangkeluar::findOrFail($id);
        $barang = Databarang::where('kodebarang', $barangKeluar->kodebarang)->first();

        DB::beginTransaction();
        try {
            if ($barang) {
                $barang->increment('stock', $barangKeluar->qty);
            }

            $barangKeluar->delete();

            DB::commit();
            return redirect()->route('barangkeluar.index')->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('warning', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    // API: Mengambil nama barang dan harga jual terakhir berdasarkan kodebarang
    public function getNamaBarang($kodebarang)
    {
        $barang = Databarang::where('kodebarang', $kodebarang)->first();
        $barangMasuk = Barangmasuk::where('kodebarang', $kodebarang)
            ->orderBy('tglmasuk', 'desc')
            ->first();

        return response()->json([
            'namabarang' => $barang?->namabarang ?? '',
            'harga_jual' => $barangMasuk?->harga_jual ?? 0,
        ]);
    }
}
