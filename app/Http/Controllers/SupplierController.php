<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataSupplier;

class SupplierController extends Controller
{
     // Tampilkan semua data supplier
     public function index()
     {
         $suppliers = DataSupplier::all();
         return view('datasupplier', compact('suppliers'));
     }
 
     // Simpan supplier baru
     public function store(Request $request)
     {
         $request->validate([
             'namasupplier' => 'required|string|max:45',
             'alamat' => 'required|string|max:255',
             'notelp' => 'required|string|max:20',
         ]);
 
         DataSupplier::create($request->all());
 
         return redirect()->route('supplier.index')->with('success', 'Supplier berhasil ditambahkan.');
     }
 
     // Update supplier
     public function update(Request $request, $id)
     {
         $supplier = DataSupplier::findOrFail($id);
 
         $request->validate([
             'namasupplier' => 'required|string|max:255',
             'alamat' => 'required|string',
             'notelp' => 'required|string|max:20',
         ]);
 
         $supplier->update($request->all());
 
         return redirect()->route('supplier.index')->with('success', 'Data Supplier berhasil diupdate.');
     }
 
     // Hapus supplier
     public function destroy($id)
     {
         $supplier = DataSupplier::findOrFail($id);
         $supplier->delete();
 
         return redirect()->route('supplier.index')->with('success', 'Data berhasil dihapus.');
     }
}
