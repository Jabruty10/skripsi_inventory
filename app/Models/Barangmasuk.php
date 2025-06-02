<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Databarang;
use App\Models\Datasupplier;

class Barangmasuk extends Model
{
    protected $table = 'barang_masuk';
    protected $primaryKey = 'idbarangmasuk';
    public $timestamps = false;

    protected $fillable = [
        'kodebarang',
        'namabarang',
        'satuan',
        'deskripsi',
        'idsupplier',
        'harga_beli',
        'harga_jual',
        'qty',
        'tglmasuk',
    ];
    

    public function barang()
    {
        return $this->belongsTo(Databarang::class, 'kodebarang', 'kodebarang');
    }

    public function supplier()
    {
        return $this->belongsTo(Datasupplier::class, 'idsupplier');
    }

}
