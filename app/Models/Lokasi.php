<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lokasi extends Model
{
    use HasFactory;
    protected $table = 'lokasi';
    protected $fillable = [
        'nama_lokasi',
        'gedung',
    ];

    public function barang()
    {
        return $this->hasMany(Barang::class);
    }
    public function lokasiAsal()
    {
        return $this->belongsTo(Lokasi::class, 'asal');
    }

    public function lokasiTujuan()
    {
        return $this->belongsTo(Lokasi::class, 'tujuan');
    }
}
