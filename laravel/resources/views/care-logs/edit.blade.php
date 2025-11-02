<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
            {{ __('Edit Log Perawatan') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-xl">
                <div class="p-8">
                    <form action="{{ route('pets.care-logs.update', [$pet, $careLog]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <label for="activity_type" class="block text-sm font-semibold text-gray-700 mb-2">Jenis Aktivitas</label>
                            <input type="text" name="activity_type" id="activity_type" value="{{ old('activity_type', $careLog->activity_type) }}" 
                                placeholder="Contoh: Vaksin, Grooming, Obat Cacing, Pemeriksaan Dokter" 
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-gray-900 focus:ring-gray-900" required>
                            @error('activity_type')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="activity_date" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Aktivitas</label>
                            <input type="date" name="activity_date" id="activity_date" value="{{ old('activity_date', $careLog->activity_date->format('Y-m-d')) }}" 
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-gray-900 focus:ring-gray-900" required>
                            @error('activity_date')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-8">
                            <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi (Opsional)</label>
                            <textarea name="description" id="description" rows="4" 
                                placeholder="Tambahkan catatan detail tentang perawatan ini..." 
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-gray-900 focus:ring-gray-900">{{ old('description', $careLog->description) }}</textarea>
                            @error('description')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex gap-3">
                            <a href="{{ route('pets.show', $pet) }}" class="flex-1 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium px-4 py-2.5 rounded-lg text-center transition duration-150 ease-in-out">
                                Batal
                            </a>
                            <button type="submit" class="flex-1 bg-gray-900 hover:bg-gray-800 text-white font-medium px-4 py-2.5 rounded-lg transition duration-150 ease-in-out shadow-sm">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>