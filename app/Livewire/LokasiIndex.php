<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Lokasi;

class LokasiIndex extends Component
{
    public $lokasiList;
    public $nama_lokasi, $gedung, $lokasi_id;
    public $updateMode = false;
    public $showModal = false;

    public function mount()
    {
        $this->lokasiList = \App\Models\Lokasi::all();
    }

    public function openModal()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function edit($id)
    {
        $lokasi = \App\Models\Lokasi::findOrFail($id);
        $this->lokasi_id = $lokasi->id;
        $this->nama_lokasi = $lokasi->nama_lokasi;
        $this->gedung = $lokasi->gedung;
        $this->updateMode = true;
        $this->showModal = true;
    }

    public function store()
    {
        $this->validate([
            'nama_lokasi' => 'required|string|max:255',
            'gedung' => 'required|string|max:255',
        ]);

        \App\Models\Lokasi::create([
            'nama_lokasi' => $this->nama_lokasi,
            'gedung' => $this->gedung,
        ]);

        $this->resetForm();
        session()->flash('message', 'Lokasi berhasil ditambahkan.');
    }

    public function update()
    {
        $this->validate([
            'nama_lokasi' => 'required|string|max:255',
            'gedung' => 'required|string|max:255',
        ]);

        $lokasi = \App\Models\Lokasi::findOrFail($this->lokasi_id);
        $lokasi->update([
            'nama_lokasi' => $this->nama_lokasi,
            'gedung' => $this->gedung,
        ]);

        $this->resetForm();
        session()->flash('message', 'Lokasi berhasil diperbarui.');
    }

    public function delete($id)
    {
        \App\Models\Lokasi::destroy($id);
        $this->lokasiList = \App\Models\Lokasi::all();
        session()->flash('message', 'Lokasi berhasil dihapus.');
    }

    private function resetForm()
    {
        $this->reset(['nama_lokasi', 'gedung', 'lokasi_id', 'updateMode', 'showModal']);
        $this->lokasiList = \App\Models\Lokasi::all();
    }
}
