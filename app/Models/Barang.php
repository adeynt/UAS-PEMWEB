<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Barang extends Model
{
    use HasFactory;
    protected $table = 'barang';
    protected $fillable = [
        'nama',
        'kode_barang',
        'kategori_id',
        'lokasi_id',
        'jumlah',
        'status',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class);
    }

    public function mutasi()
    {
        return $this->hasMany(RiwayatMutasi::class);
    }

    public function penghapusan()
    {
        return $this->hasOne(Penghapusan::class);
    }
}
