<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Card -->
            <div class="bg-gradient-to-r from-gray-800 to-gray-900 overflow-hidden shadow-lg rounded-xl mb-6">
                <div class="p-8 text-white">
                    <h3 class="text-3xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}! 👋</h3>
                    <p class="text-gray-300">Kelola semua data hewan peliharaan Anda dengan mudah</p>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Total Pets -->
                <div class="bg-white overflow-hidden shadow-sm rounded-xl">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="text-4xl">🐾</div>
                            <div class="text-right">
                                <p class="text-3xl font-bold text-gray-900">{{ Auth::user()->pets->count() }}</p>
                                <p class="text-sm text-gray-500">Total Hewan</p>
                            </div>
                        </div>
                        <a href="{{ route('pets.index') }}" class="text-gray-600 hover:text-gray-900 text-sm font-medium">
                            Lihat Semua →
                        </a>
                    </div>
                </div>

                <!-- Total Care Logs -->
                <div class="bg-white overflow-hidden shadow-sm rounded-xl">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="text-4xl">📋</div>
                            <div class="text-right">
                                <p class="text-3xl font-bold text-gray-900">{{ Auth::user()->pets->sum(fn($pet) => $pet->careLogs->count()) }}</p>
                                <p class="text-sm text-gray-500">Log Perawatan</p>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm font-medium">Total Aktivitas</p>
                    </div>
                </div>

                <!-- Quick Action -->
                <div class="bg-white overflow-hidden shadow-sm rounded-xl">
                    <div class="p-6">
                        <div class="text-center">
                            <div class="text-4xl mb-3">✨</div>
                            <p class="text-sm text-gray-600 mb-4">Mulai kelola hewan peliharaan Anda</p>
                            <a href="{{ route('pets.create') }}" class="inline-block bg-gray-900 hover:bg-gray-800 text-white font-medium px-6 py-2.5 rounded-lg text-sm transition duration-150 ease-in-out">
                                + Tambah Hewan
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Pets -->
            @if(Auth::user()->pets->count() > 0)
                <div class="bg-white overflow-hidden shadow-sm rounded-xl">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-bold text-gray-900">Hewan Peliharaan Terbaru</h3>
                            <a href="{{ route('pets.index') }}" class="text-gray-600 hover:text-gray-900 text-sm font-medium">
                                Lihat Semua →
                            </a>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach(Auth::user()->pets->take(3) as $pet)
                                <a href="{{ route('pets.show', $pet) }}" class="block border border-gray-200 rounded-lg p-4 hover:border-gray-300 hover:shadow-sm transition-all duration-150">
                                    <div class="flex items-center gap-4">
                                        @if($pet->photo)
                                            <img src="{{ Storage::url($pet->photo) }}" alt="{{ $pet->name }}" class="w-16 h-16 object-cover rounded-lg">
                                        @else
                                            <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center text-2xl">
                                                🐾
                                            </div>
                                        @endif
                                        <div>
                                            <h4 class="font-semibold text-gray-900">{{ $pet->name }}</h4>
                                            <p class="text-sm text-gray-500">{{ $pet->type }}</p>
                                            <p class="text-xs text-gray-400">{{ $pet->birth_date->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm rounded-xl">
                    <div class="p-12 text-center">
                        <div class="text-6xl mb-4">🐾</div>
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Hewan Peliharaan</h3>
                        <p class="text-gray-500 mb-6">Mulai dengan menambahkan hewan peliharaan pertama Anda</p>
                        <a href="{{ route('pets.create') }}" class="inline-block bg-gray-900 hover:bg-gray-800 text-white font-medium px-6 py-2.5 rounded-lg text-sm transition duration-150 ease-in-out">
                            + Tambah Hewan Pertama
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>