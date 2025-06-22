<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Kategori;

class KategoriIndex extends Component
{
    public $kategoriList;
    public $nama_kategori, $kategori_id;
    public $updateMode = false;
    public $showModal = false;

    public function mount()
    {
        $this->kategoriList = \App\Models\Kategori::all();
    }

    public function openModal()
    {
        $this->reset(['nama_kategori', 'kategori_id', 'updateMode']);
        $this->showModal = true;
    }

    public function store()
    {
        $this->validate([
            'nama_kategori' => 'required|string|max:255'
        ]);

        \App\Models\Kategori::create([
            'nama_kategori' => $this->nama_kategori
        ]);

        $this->resetForm();
        session()->flash('message', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kategori = \App\Models\Kategori::findOrFail($id);
        $this->kategori_id = $kategori->id;
        $this->nama_kategori = $kategori->nama_kategori;
        $this->updateMode = true;
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate([
            'nama_kategori' => 'required|string|max:255'
        ]);

        $kategori = \App\Models\Kategori::findOrFail($this->kategori_id);
        $kategori->update([
            'nama_kategori' => $this->nama_kategori
        ]);

        $this->resetForm();
        session()->flash('message', 'Kategori berhasil diperbarui.');
    }

    public function delete($id)
    {
        \App\Models\Kategori::destroy($id);
        $this->kategoriList = \App\Models\Kategori::all();
        session()->flash('message', 'Kategori berhasil dihapus.');
    }

    private function resetForm()
    {
        $this->reset(['nama_kategori', 'kategori_id', 'updateMode', 'showModal']);
        $this->kategoriList = \App\Models\Kategori::all();
    }
}
