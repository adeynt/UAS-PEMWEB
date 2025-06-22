<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <h2 class="text-xl font-semibold mb-4">Tandai Barang Rusak</h2>

        <div class="space-y-3">
            <div>
                <label class="block font-medium">Nama Barang:</label>
                <p class="border p-2 bg-gray-100">{{ optional($barangs->find($barang_id))->nama }}</p>
            </div>

            <div>
                <label class="block font-medium">Lokasi:</label>
                <p class="border p-2 bg-gray-100">
                    {{ optional(optional($barangs->find($barang_id))->lokasi)->nama_lokasi }}
                    ({{ optional(optional($barangs->find($barang_id))->lokasi)->gedung }})
                </p>
            </div>

            <div>
                <label class="block font-medium">Alasan Kerusakan:</label>
                <textarea wire:model="alasan_rusak" class="w-full border p-2 rounded" rows="3" placeholder="Contoh: Terjatuh, sudah tidak berfungsi..."></textarea>
                @error('alasan_rusak') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="flex justify-end mt-4 space-x-2">
            <button wire:click="$set('showModalRusak', false)" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
            <button wire:click="tandaiRusak({{ $barang_id }})" class="bg-red-600 text-white px-4 py-2 rounded">Tandai Rusak</button>
        </div>
    </div>
</div>
