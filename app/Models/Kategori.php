<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Databarang;

class Kategori extends Model
{
    protected $table = 'kategori'; 
    protected $primaryKey = 'kodekategori';
    public $timestamps = false; 
    public $incrementing = false; 
    protected $keyType = 'string';

    protected $fillable = [
        'kodekategori',
        'namakategori',
    ];
    public function getRouteKeyName()
    {
        return 'kodekategori';
    }
    public function barang()
    {
        return $this->hasMany(Databarang::class, 'kodekategori', 'kodekategori');
    }



}
