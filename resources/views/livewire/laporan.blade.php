<div class="bg-black min-h-screen text-white">
    <div>
        <div class="p-4">
            <h1 class="text-2xl font-bold mb-4">Laporan Barang Aktif per Lokasi</h1>

            <div class="space-y-4">
                @forelse ($laporan as $lokasi)
                    <div x-data="{ open: false }" class="border rounded-md shadow-sm p-4 bg-gray-800">
                        <div class="flex justify-between items-center">
                            <div>
                                <h2 class="text-lg font-semibold">{{ $lokasi->nama_lokasi }} ({{ $lokasi->gedung }})</h2>
                                <p class="text-sm text-gray-300">Jumlah Barang Aktif: {{ $lokasi->barang->count() }}</p>
                            </div>
                            <button @click="open = !open" class="text-blue-400 hover:underline">
                                <span x-show="!open">Tampilkan</span>
                                <span x-show="open">Sembunyikan</span> Rincian
                            </button>
                        </div>

                        <div x-show="open" class="mt-4">
                            <table class="w-full table-auto border border-gray-600 text-white">
                                <thead class="bg-gray-700">
                                    <tr>
                                        <th class="border px-2 py-1 text-left">Nama Barang</th>
                                        <th class="border px-2 py-1 text-left">Kode</th>
                                        <th class="border px-2 py-1 text-left">Kategori</th>
                                        <th class="border px-2 py-1 text-left">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lokasi->barang as $barang)
                                        <tr class="border-gray-600">
                                            <td class="border px-2 py-1">{{ $barang->nama }}</td>
                                            <td class="border px-2 py-1">{{ $barang->kode_barang }}</td>
                                            <td class="border px-2 py-1">{{ $barang->kategori->nama_kategori ?? '-' }}</td>
                                            <td class="border px-2 py-1">{{ $barang->jumlah }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-300">Tidak ada data lokasi/barang aktif.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
