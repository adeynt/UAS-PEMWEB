<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-lg">
        <h2 class="text-xl font-semibold mb-4">Tambah Barang</h2>

        <form wire:submit.prevent="store" class="space-y-3">
            @include('livewire.partials.form-fields')

            <div class="flex justify-end space-x-2 mt-4">
                <button type="button" wire:click="$set('showModalTambah', false)"
                    class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>
