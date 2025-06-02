<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Datapembeli;

class PembeliController extends Controller
{
     // Tampilkan semua data pembeli
     public function index()
     {
         $pembelis = Datapembeli::all();
         return view('datapembeli', compact('pembelis'));
     }
 
     // Simpan pembeli baru
     public function store(Request $request)
     {
         $request->validate([
             'namapembeli' => 'required|string|max:45',
             'alamat' => 'required|string|max:255',
             'notelp' => 'required|string|max:20',
         ]);
 
         Datapembeli::create($request->all());
 
         return redirect()->route('pembeli.index')->with('success', 'Pembeli berhasil ditambahkan.');
     }
 
     // Update pembeli
     public function update(Request $request, $id)
     {
         $pembeli = Datapembeli::findOrFail($id);
 
         $request->validate([
             'namapembeli' => 'required|string|max:45',
             'alamat' => 'required|string|max:255',
             'notelp' => 'required|string|max:20',
         ]);
 
         $pembeli->update($request->all());
 
         return redirect()->route('pembeli.index')->with('success', 'Data Pembeli berhasil diupdate.');
     }
 
     // Hapus supplier
     public function destroy($id)
     {
         $pembeli = Datapembeli::findOrFail($id);
         $pembeli->delete();
 
         return redirect()->route('pembeli.index')->with('success', 'Data berhasil dihapus.');
     }
}

