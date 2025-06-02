<?php

namespace App\Http\Controllers\Databarang;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();
        return view('databarang.kategori', compact('kategoris'));
    }

    public function create()
    {
        return view('databarang.kategori');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kodekategori' => 'required|unique:kategori,kodekategori'.'|string|max:10',
            'namakategori' => 'required|string|max:50',
        ]);

        Kategori::create($request->all());

        return redirect()->route('databarang.kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }
    public function update(Request $request, $kodekategori)
    {
        $kategori = Kategori::where('kodekategori', $kodekategori)->firstOrFail();
        $kategori->namakategori = $request->namakategori;
        $kategori->save();

        return redirect()->route('databarang.kategori.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($kodekategori)
    {
        $kategori = Kategori::where('kodekategori', $kodekategori)->firstOrFail();
        $kategori->delete();

        return redirect()->route('databarang.kategori.index')->with('success', 'Data berhasil dihapus.');
    }

}
