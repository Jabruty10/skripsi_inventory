<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Barangkeluar;

class Datapembeli extends Model
{
    use HasFactory;

    protected $table = 'pembeli';

    protected $primaryKey = 'idpembeli'; 

    public $timestamps = false; 

    protected $fillable = [
        'namapembeli',
        'alamat',
        'notelp',
    ];

    public function barangKeluar()
    {
        return $this->hasMany(Barangkeluar::class, 'idpembeli', 'idpembeli');
    }
}
