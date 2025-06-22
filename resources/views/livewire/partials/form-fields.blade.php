<div>
    <label>Nama Barang</label>
    <input type="text" wire:model="nama" class="border p-1 w-full">
    @error('nama') <span class="text-red-600">{{ $message }}</span> @enderror
</div>

<div>
    <label>Kode Barang</label>
    <input type="text" wire:model="kode_barang" class="border p-1 w-full">
    @error('kode_barang') <span class="text-red-600">{{ $message }}</span> @enderror
</div>

<div>
    <label>Kategori</label>
    <select wire:model="kategori_id" class="border p-1 w-full">
        <option value="">-- Pilih Kategori --</option>
        @foreach ($kategoriList as $kategori)
            <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
        @endforeach
    </select>
    @error('kategori_id') <span class="text-red-600">{{ $message }}</span> @enderror
</div>

<div>
    <label>Lokasi</label>
    <select wire:model="lokasi_id" class="border p-1 w-full">
        <option value="">-- Pilih Lokasi --</option>
        @foreach ($lokasiList as $lokasi)
            <option value="{{ $lokasi->id }}">{{ $lokasi->nama_lokasi }} ({{ $lokasi->gedung }})</option>
        @endforeach
    </select>
    @error('lokasi_id') <span class="text-red-600">{{ $message }}</span> @enderror
</div>

<div>
    <label>Jumlah</label>
    <input type="number" wire:model="jumlah" class="border p-1 w-full">
    @error('jumlah') <span class="text-red-600">{{ $message }}</span> @enderror
</div>
