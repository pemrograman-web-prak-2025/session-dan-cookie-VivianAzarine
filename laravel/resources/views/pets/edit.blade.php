<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Hewan Peliharaan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('pets.update', $pet) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Hewan</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $pet->name) }}" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-gray-500 focus:ring-gray-500" required>
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Jenis Hewan</label>
                            <input type="text" name="type" id="type" value="{{ old('type', $pet->type) }}" 
                                placeholder="Contoh: Kucing, Anjing, Kelinci" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-gray-500 focus:ring-gray-500" required>
                            @error('type')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
                            <input type="date" name="birth_date" id="birth_date" value="{{ old('birth_date', $pet->birth_date->format('Y-m-d')) }}" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-gray-500 focus:ring-gray-500" required>
                            @error('birth_date')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        @if($pet->photo)
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Foto Saat Ini</label>
                                <img src="{{ Storage::url($pet->photo) }}" alt="{{ $pet->name }}" class="w-32 h-32 object-cover rounded">
                            </div>
                        @endif

                        <div class="mb-4">
                            <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">Ganti Foto (Opsional)</label>
                            <input type="file" name="photo" id="photo" accept="image/*" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-gray-500 focus:ring-gray-500">
                            @error('photo')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Catatan (Opsional)</label>
                            <textarea name="notes" id="notes" rows="4" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-gray-500 focus:ring-gray-500">{{ old('notes', $pet->notes) }}</textarea>
                            @error('notes')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex gap-3">
                            <a href="{{ route('pets.index') }}" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md text-center">
                                Batal
                            </a>
                            <button type="submit" class="flex-1 bg-gray-800 hover:bg-gray-700 text-white px-4 py-2 rounded-md">
                                Update
                            </button>
                        </div>
                    </form>

                    <form action="{{ route('pets.destroy', $pet) }}" method="POST" class="mt-6 pt-6 border-t" 
                        onsubmit="return confirm('Yakin ingin menghapus hewan peliharaan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md">
                            Hapus Hewan Peliharaan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>