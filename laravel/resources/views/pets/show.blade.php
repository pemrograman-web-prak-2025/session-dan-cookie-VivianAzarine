<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
                {{ $pet->name }}
            </h2>
            <a href="{{ route('pets.index') }}" class="text-gray-600 hover:text-gray-900 font-medium text-sm transition duration-150 ease-in-out">
                ← Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-400 text-green-800 px-4 py-3 rounded-r shadow-sm">
                    <p class="font-medium">{{ session('success') }}</p>
                </div>
            @endif

            <!-- Detail Hewan -->
            <div class="bg-white overflow-hidden shadow-sm rounded-xl">
                <div class="p-8">
                    <div class="flex flex-col md:flex-row gap-8">
                        @if($pet->photo)
                            <div class="w-full md:w-80 h-80 rounded-xl overflow-hidden shadow-md">
                                <img src="{{ Storage::url($pet->photo) }}" alt="{{ $pet->name }}" class="w-full h-full object-cover">
                            </div>
                        @else
                            <div class="w-full md:w-80 h-80 bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center rounded-xl shadow-md">
                                <span class="text-8xl">🐾</span>
                            </div>
                        @endif

                        <div class="flex-1">
                            <h3 class="text-3xl font-bold text-gray-900 mb-6">{{ $pet->name }}</h3>
                            
                            <div class="space-y-4 text-gray-700 mb-8">
                                <div class="flex items-start">
                                    <span class="font-semibold w-32">Jenis:</span>
                                    <span>{{ $pet->type }}</span>
                                </div>
                                <div class="flex items-start">
                                    <span class="font-semibold w-32">Tanggal Lahir:</span>
                                    <span>{{ $pet->birth_date->format('d M Y') }}</span>
                                </div>
                                <div class="flex items-start">
                                    <span class="font-semibold w-32">Umur:</span>
                                    <span>{{ $pet->birth_date->diffInYears(now()) }} tahun</span>
                                </div>
                                @if($pet->notes)
                                    <div class="flex items-start">
                                        <span class="font-semibold w-32">Catatan:</span>
                                        <span class="flex-1">{{ $pet->notes }}</span>
                                    </div>
                                @endif
                            </div>

                            <a href="{{ route('pets.edit', $pet) }}" class="inline-block bg-gray-900 hover:bg-gray-800 text-white font-medium px-6 py-2.5 rounded-lg text-sm transition duration-150 ease-in-out">
                                Edit Data Hewan
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Daftar Log Perawatan -->
            <div class="bg-white overflow-hidden shadow-sm rounded-xl">
                <div class="p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-bold text-gray-900">Log Perawatan</h3>
                        <a href="{{ route('pets.care-logs.create', $pet) }}" class="bg-gray-900 hover:bg-gray-800 text-white font-medium px-6 py-2.5 rounded-lg text-sm transition duration-150 ease-in-out shadow-sm">
                            + Tambah Log
                        </a>
                    </div>

                    @if($pet->careLogs->isEmpty())
                        <div class="text-center py-12">
                            <div class="text-5xl mb-4">📋</div>
                            <p class="text-gray-500">Belum ada log perawatan untuk {{ $pet->name }}</p>
                        </div>
                    @else
                        <div class="space-y-3">
                            @foreach($pet->careLogs as $log)
                                <div class="border border-gray-200 rounded-lg p-5 hover:border-gray-300 hover:shadow-sm transition-all duration-150">
                                    <div class="flex justify-between items-start mb-3">
                                        <div>
                                            <h4 class="font-semibold text-lg text-gray-900">{{ $log->activity_type }}</h4>
                                            <p class="text-sm text-gray-500 mt-1">{{ $log->activity_date->format('d M Y') }}</p>
                                        </div>
                                        <div class="flex gap-3">
                                            <a href="{{ route('pets.care-logs.edit', [$pet, $log]) }}" class="text-gray-600 hover:text-gray-900 font-medium text-sm transition duration-150 ease-in-out">
                                                Edit
                                            </a>
                                            <form action="{{ route('pets.care-logs.destroy', [$pet, $log]) }}" method="POST" 
                                                onsubmit="return confirm('Yakin ingin menghapus log ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-sm transition duration-150 ease-in-out">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    @if($log->description)
                                        <p class="text-gray-600 text-sm leading-relaxed">{{ $log->description }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>