<div class="p-4">
    @if (session()->has('message'))
        <div class="bg-green-200 text-green-800 p-2 mb-4 rounded">
            {{ session('message') }}
        </div>
    @endif

    <div class="mb-4">
        <button wire:click="openModal" class="bg-blue-600 text-white px-4 py-2 rounded">Tambah Kategori</button>
    </div>

    <h2 class="mt-6 font-bold">Daftar Kategori</h2>
    <table class="w-full border-collapse border border-gray-300 mt-2">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 p-2">Nama Kategori</th>
                <th class="border border-gray-300 p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kategoriList as $kategori)
                <tr>
                    <td class="border border-gray-300 p-2">{{ $kategori->nama_kategori }}</td>
                    <td class="border border-gray-300 p-2 space-x-1">
                        <button wire:click="edit({{ $kategori->id }})" class="bg-yellow-400 px-2 py-1 rounded">Edit</button>
                        <button wire:click="delete({{ $kategori->id }})" onclick="confirm('Yakin mau hapus?') || event.stopImmediatePropagation()" class="bg-red-600 text-white px-2 py-1 rounded">Hapus</button>
                    </td>
                </tr>
            @endforeach
            @if($kategoriList->isEmpty())
                <tr>
                    <td colspan="2" class="text-center p-4">Data kategori kosong</td>
                </tr>
            @endif
        </tbody>
    </table>

    @if ($showModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg w-full max-w-md">
                <h2 class="text-xl font-semibold mb-4">
                    {{ $updateMode ? 'Edit Kategori' : 'Tambah Kategori' }}
                </h2>

                <form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}" class="space-y-3">
                    <div>
                        <label>Nama Kategori</label>
                        <input type="text" wire:model="nama_kategori" class="border p-1 w-full" placeholder="Masukkan nama kategori">
                        @error('nama_kategori') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end mt-4 space-x-2">
                        <button wire:click="$set('showModal', false)" type="button" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                            {{ $updateMode ? 'Update' : 'Simpan' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
