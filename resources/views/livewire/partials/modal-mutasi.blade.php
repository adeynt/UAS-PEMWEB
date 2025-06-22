<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <h2 class="text-xl font-semibold mb-4">Mutasi Barang</h2>

        <form wire:submit.prevent="simpanMutasi" class="space-y-3">
            <div>
                <label class="block">Dari Lokasi:</label>
                <select class="w-full border p-1" disabled>
                    @foreach ($lokasiList as $lokasi)
                        @if ($lokasi->id == $asal)
                            <option value="{{ $lokasi->id }}">{{ $lokasi->nama_lokasi }} ({{ $lokasi->gedung }})</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block">Ke Lokasi:</label>
                <select wire:model="tujuan" class="w-full border p-1">
                    <option value="">-- Pilih Lokasi Tujuan --</option>
                    @foreach ($lokasiList as $lokasi)
                        @if ($lokasi->id != $asal)
                            <option value="{{ $lokasi->id }}">{{ $lokasi->nama_lokasi }} ({{ $lokasi->gedung }})</option>
                        @endif
                    @endforeach
                </select>
                @error('tujuan') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block">Tanggal Mutasi:</label>
                <input type="date" wire:model="tanggal_mutasi" class="w-full border p-1">
                @error('tanggal_mutasi') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-end space-x-2 mt-4">
                <button type="button" wire:click="$set('showModalMutasi', false)"
                    class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan Mutasi</button>
            </div>
        </form>
    </div>
</div>
