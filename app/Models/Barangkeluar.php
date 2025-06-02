<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Databarang;
use App\Models\Datapembeli;

class Barangkeluar extends Model
{
    
    protected $table = 'barang_keluar';
    protected $primaryKey = 'idbarangkeluar';
    public $timestamps = false;

    protected $fillable = [
        'kodebarang',
        'namabarang',
        'idpembeli',
        'harga_jual',
        'qty',
        'tglkeluar'
    ];

    public function barang()
    {
        return $this->belongsTo(Databarang::class, 'kodebarang');
    }

    public function pembeli()
    {
        return $this->belongsTo(Datapembeli::class, 'idpembeli');
    }
}
