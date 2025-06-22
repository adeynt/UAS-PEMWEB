<div>
<div class="p-4">

    @if (session()->has('message'))
        <div class="bg-green-200 text-green-800 p-2 mb-4 rounded">
            {{ session('message') }}
        </div>
    @endif

    <button wire:click="openModalTambah" class="bg-blue-600 text-white px-4 py-2 rounded mb-4">
        Tambah Barang
    </button>

    <h2 class="font-bold">Daftar Barang</h2>

    <table class="w-full border mt-4">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2 border">Nama</th>
                <th class="p-2 border">Kode</th>
                <th class="p-2 border">Kategori</th>
                <th class="p-2 border">Lokasi</th>
                <th class="p-2 border">Jumlah</th>
                <th class="p-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($barangs as $barang)
                <tr>
                    <td class="p-2 border">{{ $barang->nama }}</td>
                    <td class="p-2 border">{{ $barang->kode_barang }}</td>
                    <td class="p-2 border">{{ $barang->kategori->nama_kategori ?? '-' }}</td>
                    <td class="p-2 border">{{ $barang->lokasi->nama_lokasi ?? '-' }}</td>
                    <td class="p-2 border">{{ $barang->jumlah }}</td>
                    <td class="p-2 border space-x-1">
                        <button wire:click="openModalEdit({{ $barang->id }})"
                            class="bg-yellow-400 px-2 py-1 rounded">Edit</button>

                        @if ($barang->status === 'rusak')
                            <button
                                onclick="confirm('Hapus barang rusak ini?') && @this.call('delete', {{ $barang->id }})"
                                class="bg-red-800 text-white px-2 py-1 rounded">
                                Hapus
                            </button>
                        @elseif ($barang->status !== 'mutasi')
                            <button
                                onclick="confirm('Yakin ingin tandai sebagai rusak?') && @this.call('openModalRusak', {{ $barang->id }})"
                                class="bg-red-600 text-white px-2 py-1 rounded">
                                Rusak
                            </button>
                        @endif

                        @if ($barang->status !== 'rusak')
                            <button wire:click="openModalMutasi({{ $barang->id }})"
                                class="bg-green-600 text-white px-2 py-1 rounded">
                                Mutasi
                            </button>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center p-4">Data barang kosong</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if ($showModalTambah)
        @include('livewire.partials.modal-tambah')
    @endif

    @if ($showModalEdit)
        @include('livewire.partials.modal-edit')
    @endif

    @if ($showModalRusak)
        @include('livewire.partials.modal-rusak')
    @endif

    @if ($showModalMutasi)
        @include('livewire.partials.modal-mutasi')
    @endif

</div>
</div>
