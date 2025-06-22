<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Lokasi;

class Laporan extends Component
{
    public function render()
    {
        $laporan = Lokasi::with(['barang' => function ($query) {
            $query->where('status', 'normal');
        }, 'barang.kategori'])->get();

        return view('livewire.laporan', compact('laporan'));
    }
}
