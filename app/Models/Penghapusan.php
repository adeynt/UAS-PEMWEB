<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penghapusan extends Model
{
    use HasFactory;
    protected $table = 'penghapusan';
    protected $fillable = [
        'barang_id',
        'alasan',
        'tanggal',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
