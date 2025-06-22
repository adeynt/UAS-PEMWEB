<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Barang;
use App\Models\Lokasi;

class RiwayatMutasi extends Model
{
    use HasFactory;

    protected $table = 'riwayat_mutasi';

    protected $fillable = [
        'barang_id', 
        'asal', 
        'tujuan', 
        'tanggal'
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function asalLokasi()
    {
        return $this->belongsTo(Lokasi::class, 'asal');
    }

    public function tujuanLokasi()
    {
        return $this->belongsTo(Lokasi::class, 'tujuan');
    }
}

