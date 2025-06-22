<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\RiwayatMutasi;

class MutasiIndex extends Component
{
    public function render()
    {
        $riwayatMutasi = RiwayatMutasi::with(['barang', 'asalLokasi', 'tujuanLokasi'])->get();

        return view('livewire.mutasi-index', [
            'riwayatMutasi' => $riwayatMutasi
        ]);
    }
}
