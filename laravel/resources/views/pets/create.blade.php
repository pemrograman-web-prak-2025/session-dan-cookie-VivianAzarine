<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
            {{ __('Tambah Hewan Peliharaan') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-xl">
                <div class="p-8">
                    <form action="{{ route('pets.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-6">
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Hewan</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" 
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-gray-900 focus:ring-gray-900" required>
                            @error('name')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="type" class="block text-sm font-semibold text-gray-700 mb-2">Jenis Hewan</label>
                            <input type="text" name="type" id="type" value="{{ old('type') }}" 
                                placeholder="Contoh: Kucing, Anjing, Kelinci" 
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-gray-900 focus:ring-gray-900" required>
                            @error('type')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="birth_date" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Lahir</label>
                            <input type="date" name="birth_date" id="birth_date" value="{{ old('birth_date') }}" 
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-gray-900 focus:ring-gray-900" required>
                            @error('birth_date')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="photo" class="block text-sm font-semibold text-gray-700 mb-2">Foto (Opsional)</label>
                            <input type="file" name="photo" id="photo" accept="image/*" 
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-gray-900 focus:ring-gray-900 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                            @error('photo')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-8">
                            <label for="notes" class="block text-sm font-semibold text-gray-700 mb-2">Catatan (Opsional)</label>
                            <textarea name="notes" id="notes" rows="4" 
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-gray-900 focus:ring-gray-900">{{ old('notes') }}</textarea>
                            @error('notes')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex gap-3">
                            <a href="{{ route('pets.index') }}" class="flex-1 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium px-4 py-2.5 rounded-lg text-center transition duration-150 ease-in-out">
                                Batal
                            </a>
                            <button type="submit" class="flex-1 bg-gray-900 hover:bg-gray-800 text-white font-medium px-4 py-2.5 rounded-lg transition duration-150 ease-in-out shadow-sm">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>