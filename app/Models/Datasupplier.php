<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Barangmasuk;

class Datasupplier extends Model
{
    
    use HasFactory;

    protected $table = 'supplier'; // nama tabel di database

    protected $primaryKey = 'idsupplier'; // primary key kustom

    public $timestamps = false; // nonaktifkan timestamps (created_at, updated_at)

    protected $fillable = [
        'namasupplier',
        'alamat',
        'notelp',
    ];

    // Relasi jika nanti ada barangMasuk
    public function barangMasuk()
    {
        return $this->hasMany(Barangmasuk::class, 'idsupplier', 'idsupplier');
    }
}
