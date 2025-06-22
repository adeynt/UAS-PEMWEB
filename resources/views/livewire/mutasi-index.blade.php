<div class="bg-black min-h-screen text-white">
    <div class="p-4">
        <h2 class="text-xl font-bold mb-4">Riwayat Mutasi Barang</h2>

        @if(session()->has('message'))
            <div class="bg-green-800 border border-green-600 text-green-200 px-4 py-2 rounded mb-4">
                {{ session('message') }}
            </div>
        @endif

        <table class="w-full border-collapse border border-gray-600 bg-gray-800 shadow">
            <thead class="bg-gray-700">
                <tr>
                    <th class="border p-2 text-left">Nama Barang</th>
                    <th class="border p-2 text-left">Lokasi Asal</th>
                    <th class="border p-2 text-left">Lokasi Tujuan</th>
                    <th class="border p-2 text-left">Tanggal Mutasi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($riwayatMutasi as $mutasi)
                    <tr class="hover:bg-gray-700">
                        <td class="border p-2">{{ $mutasi->barang->nama ?? '-' }}</td>
                        <td class="border p-2">{{ $mutasi->asalLokasi->nama_lokasi ?? '-' }}</td>
                        <td class="border p-2">{{ $mutasi->tujuanLokasi->nama_lokasi ?? '-' }}</td>
                        <td class="border p-2">{{ \Carbon\Carbon::parse($mutasi->tanggal)->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="border p-4 text-center text-gray-400">Belum ada riwayat mutasi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
