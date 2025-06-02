<?php

namespace App\Http\Controllers;

use App\Models\Databarang;
use App\Models\Barangmasuk;
use App\Models\BarangKeluar;
use App\Models\Datapembeli;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBarang = Databarang::count();
        $totalBarangMasuk = Barangmasuk::count();
        $totalBarangKeluar = Barangkeluar::count();
        $totalPembeli = Datapembeli::count();

        return view('index', compact(
            'totalBarang',
            'totalBarangMasuk',
            'totalBarangKeluar',
            'totalPembeli'
        ));
    }
}
