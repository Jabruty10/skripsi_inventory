<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;
use App\Models\Barangmasuk;
use App\Models\Barangkeluar;

class Databarang extends Model
{
    protected $table = 'barangs'; 

    protected $primaryKey = 'kodebarang'; 
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'kodebarang',
        'kodekategori',
        'namabarang',
        'deskripsi',
        'satuan',
        'stock',
    ];
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kodekategori', 'kodekategori');
    }

    public function barangmasuk()
    {
        return $this->belongsTo(Barangmasuk::class, 'idbarangmasuk');
    }
    public function barangkeluar()
    {
        return $this->belongsTo(Barangkeluar::class, 'idbarangkeluar');
    }

}
