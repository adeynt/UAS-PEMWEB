<div class="p-4">
    @if (session()->has('message'))
        <div class="bg-green-200 text-green-800 p-2 mb-4 rounded">
            {{ session('message') }}
        </div>
    @endif

    <div class="mb-4">
        <button wire:click="openModal" class="bg-blue-600 text-white px-4 py-2 rounded">
            Tambah Lokasi
        </button>
    </div>

    <h2 class="mt-6 font-bold">Daftar Lokasi</h2>

    <table class="w-full border-collapse border border-gray-300 mt-2">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 p-2">Nama Lokasi</th>
                <th class="border border-gray-300 p-2">Gedung</th>
                <th class="border border-gray-300 p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lokasiList as $lokasi)
                <tr>
                    <td class="border border-gray-300 p-2">{{ $lokasi->nama_lokasi }}</td>
                    <td class="border border-gray-300 p-2">{{ $lokasi->gedung}}</td>
                    <td class="border border-gray-300 p-2 space-x-1">
                        <button wire:click="edit({{ $lokasi->id }})" class="bg-yellow-400 px-2 py-1 rounded">Edit</button>
                        <button wire:click="delete({{ $lokasi->id }})" onclick="confirm('Yakin mau hapus?') || event.stopImmediatePropagation()" class="bg-red-600 text-white px-2 py-1 rounded">Hapus</button>
                    </td>
                </tr>
            @endforeach
            @if($lokasiList->isEmpty())
                <tr>
                    <td colspan="3" class="text-center p-4">Data lokasi kosong</td>
                </tr>
            @endif
        </tbody>
    </table>

    @if($showModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg w-full max-w-md">
                <h2 class="text-xl font-semibold mb-4">
                    {{ $updateMode ? 'Edit Lokasi' : 'Tambah Lokasi' }}
                </h2>

                <form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}" class="space-y-3">
                    <div>
                        <label>Nama Lokasi</label>
                        <input type="text" wire:model="nama_lokasi" class="border p-1 w-full" placeholder="Masukkan nama lokasi">
                        @error('nama_lokasi') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label>Nama Gedung</label>
                        <input type="text" wire:model="gedung" class="border p-1 w-full" placeholder="Masukkan nama gedung">
                        @error('gedung') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end space-x-2 mt-4">
                        <button type="button" wire:click="$set('showModal', false)" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                            {{ $updateMode ? 'Update' : 'Simpan' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
