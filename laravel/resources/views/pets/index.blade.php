<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
                {{ __('Daftar Hewan Peliharaan') }}
            </h2>
            <a href="{{ route('pets.create') }}" class="bg-gray-900 hover:bg-gray-800 text-white font-medium px-6 py-2.5 rounded-lg text-sm transition duration-150 ease-in-out shadow-sm">
                + Tambah Hewan
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-400 text-green-800 px-4 py-3 rounded-r mb-6 shadow-sm">
                    <p class="font-medium">{{ session('success') }}</p>
                </div>
            @endif

            @if($pets->isEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl">
                    <div class="p-12 text-center">
                        <div class="text-6xl mb-4">🐾</div>
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Hewan Peliharaan</h3>
                        <p class="text-gray-500 mb-6">Mulai dengan menambahkan hewan peliharaan pertama Anda</p>
                        <a href="{{ route('pets.create') }}" class="inline-block bg-gray-900 hover:bg-gray-800 text-white font-medium px-6 py-2.5 rounded-lg text-sm transition duration-150 ease-in-out">
                            + Tambah Hewan Pertama
                        </a>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($pets as $pet)
                        <div class="bg-white overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-200 rounded-xl">
                            @if($pet->photo)
                                <div class="relative h-56 overflow-hidden">
                                    <img src="{{ Storage::url($pet->photo) }}" alt="{{ $pet->name }}" class="w-full h-full object-cover">
                                </div>
                            @else
                                <div class="relative h-56 bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center">
                                    <span class="text-7xl">🐾</span>
                                </div>
                            @endif
                            
                            <div class="p-6">
                                <h3 class="font-bold text-xl text-gray-900 mb-1">{{ $pet->name }}</h3>
                                <p class="text-sm text-gray-600 mb-1">{{ $pet->type }}</p>
                                <p class="text-xs text-gray-500 mb-5">Lahir {{ $pet->birth_date->format('d M Y') }}</p>
                                
                                <div class="flex gap-3">
                                    <a href="{{ route('pets.show', $pet) }}" class="flex-1 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium px-4 py-2.5 rounded-lg text-sm text-center transition duration-150 ease-in-out">
                                        Detail
                                    </a>
                                    <a href="{{ route('pets.edit', $pet) }}" class="flex-1 bg-gray-900 hover:bg-gray-800 text-white font-medium px-4 py-2.5 rounded-lg text-sm text-center transition duration-150 ease-in-out">
                                        Edit
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>