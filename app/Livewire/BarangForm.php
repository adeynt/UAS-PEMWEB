<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Lokasi;
use App\Models\Penghapusan;
use App\Models\RiwayatMutasi;

class BarangForm extends Component
{
    public $barangs, $kategoriList, $lokasiList;

    public $nama, $kode_barang, $kategori_id, $lokasi_id, $jumlah, $barang_id;
    public $updateMode = false;

    public $showModalTambah = false;
    public $showModalEdit = false;
    public $showModalRusak = false;
    public $showModalMutasi = false;

    public $barang_id_mutasi, $asal, $tujuan, $tanggal_mutasi;
    public $alasan_rusak;

    public function render()
    {
        $this->barangs = Barang::with(['kategori', 'lokasi'])->get();
        $this->kategoriList = Kategori::all();
        $this->lokasiList = Lokasi::all();

        return view('livewire.barang-form');
    }

    private function resetInputFields()
    {
        $this->nama = '';
        $this->kode_barang = '';
        $this->kategori_id = '';
        $this->lokasi_id = '';
        $this->jumlah = '';
        $this->barang_id = null;
        $this->updateMode = false;
    }

    public function openModalTambah()
    {
        $this->resetInputFields();
        $this->showModalTambah = true;
    }

    public function closeModalTambah()
    {
        $this->showModalTambah = false;
    }

    public function openModalEdit($id)
    {
        $barang = Barang::findOrFail($id);
        $this->barang_id = $barang->id;
        $this->nama = $barang->nama;
        $this->kode_barang = $barang->kode_barang;
        $this->kategori_id = $barang->kategori_id;
        $this->lokasi_id = $barang->lokasi_id;
        $this->jumlah = $barang->jumlah;
        $this->updateMode = true;
        $this->showModalEdit = true;
    }

    public function closeModalEdit()
    {
        $this->showModalEdit = false;
    }

    public function openModalRusak($id)
    {
        $this->barang_id = $id;
        $this->alasan_rusak = '';
        $this->showModalRusak = true;
    }

    public function closeModalRusak()
    {
        $this->showModalRusak = false;
    }

    public function openModalMutasi($id)
    {
        $barang = Barang::findOrFail($id);
        $this->barang_id_mutasi = $id;
        $this->asal = $barang->lokasi_id;
        $this->tujuan = '';
        $this->tanggal_mutasi = now()->toDateString();
        $this->showModalMutasi = true;
    }

    public function closeModalMutasi()
    {
        $this->showModalMutasi = false;
    }

    public function store()
    {
        $validatedData = $this->validate([
            'nama' => 'required|string|max:255',
            'kode_barang' => 'required|string|unique:barang,kode_barang',
            'kategori_id' => 'required|exists:kategori,id',
            'lokasi_id' => 'required|exists:lokasi,id',
            'jumlah' => 'required|integer|min:0',
        ]);

        $validatedData['status'] = 'normal';
        Barang::create($validatedData);

        session()->flash('message', 'Barang berhasil ditambahkan.');
        $this->resetInputFields();
        $this->closeModalTambah();
    }

    public function update()
    {
        $validatedData = $this->validate([
            'nama' => 'required|string|max:255',
            'kode_barang' => 'required|string|unique:barang,kode_barang,' . $this->barang_id,
            'kategori_id' => 'required|exists:kategori,id',
            'lokasi_id' => 'required|exists:lokasi,id',
            'jumlah' => 'required|integer|min:0',
        ]);

        Barang::findOrFail($this->barang_id)->update($validatedData);

        session()->flash('message', 'Barang berhasil diupdate.');
        $this->resetInputFields();
        $this->closeModalEdit();
    }

    public function tandaiRusak($id)
    {
        $barang = Barang::findOrFail($id);

        if ($barang->status === 'rusak') {
            session()->flash('message', 'Barang sudah ditandai sebagai rusak.');
            return;
        }

        if ($barang->status === 'mutasi') {
            session()->flash('message', 'Barang sedang dalam status mutasi dan tidak bisa ditandai rusak.');
            return;
        }

        $barang->status = 'rusak';
        $barang->save();

        Penghapusan::create([
            'barang_id' => $barang->id,
            'alasan' => 'Barang rusak (ditandai manual)',
            'tanggal' => now()->toDateString(),
        ]);

        session()->flash('message', 'Barang berhasil ditandai sebagai rusak dan dicatat dalam penghapusan.');
    }


    public function delete($id)
    {
        $barang = Barang::findOrFail($id);

        if (strtolower(trim($barang->status)) === 'mutasi') {
            session()->flash('message', 'Barang sedang dimutasi dan tidak bisa dihapus.');
            return;
        }

        $barang->delete();
        session()->flash('message', 'Barang berhasil dihapus.');
    }

    public function simpanMutasi()
    {
        $this->validate([
            'tujuan' => 'required|different:asal|exists:lokasi,id',
            'tanggal_mutasi' => 'required|date',
        ]);

        RiwayatMutasi::create([
            'barang_id' => $this->barang_id_mutasi,
            'asal' => $this->asal,
            'tujuan' => $this->tujuan,
            'tanggal' => $this->tanggal_mutasi,
        ]);

        $barang = Barang::findOrFail($this->barang_id_mutasi);
        $barang->lokasi_id = $this->tujuan;
        $barang->status = 'mutasi';
        $barang->save();

        $this->closeModalMutasi();
        $this->barang_id_mutasi = null;

        session()->flash('message', 'Mutasi barang berhasil diproses.');
    }

    public function cancel()
    {
        $this->resetInputFields();
        $this->updateMode = false;
        $this->closeModalTambah();
        $this->closeModalEdit();
    }
}
