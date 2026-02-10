@extends('layout.admin')

@section('title', 'Tambah SPP')

@section('content')

<!-- HEADER -->
<div class="mb-8">
    <div class="flex items-center gap-3 text-sm text-gray-600 mb-4">
        <a href="{{ route('spp.index') }}" class="hover:text-maroon transition flex items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Data SPP
        </a>
        <span>/</span>
        <span class="text-gray-900 font-medium">Tambah SPP</span>
    </div>
    <h2 class="text-2xl font-bold text-gray-800">Tambah SPP Baru</h2>
    <p class="text-gray-600 text-sm mt-1">Tambahkan Standar Biaya Pendidikan untuk tahun ajaran baru</p>
</div>

<div class="max-w-2xl mx-auto">

    <!-- FORM CARD -->
    <div class="bg-white rounded-lg shadow-md border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-maroon to-maroonLight p-6">
            <h3 class="text-white font-semibold flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Formulir SPP Baru
            </h3>
        </div>

        <div class="p-6">
            <form action="{{ route('spp.store') }}" method="POST" class="space-y-6" id="sppForm">
                @csrf

                <!-- ERROR VALIDASI -->
                @if(session('error'))
                <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-lg">
                    <div class="flex items-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <p class="font-medium text-sm">Terjadi kesalahan:</p>
                            <p class="text-sm mt-1">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
                @endif

                @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-lg">
                    <div class="flex items-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <p class="font-medium text-sm">Terjadi kesalahan:</p>
                            <ul class="list-disc list-inside text-sm mt-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endif

                <!-- TAHUN -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <span class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Tahun Ajaran
                        </span>
                    </label>
                    <input type="number" name="tahun" value="{{ old('tahun') }}" required
                           id="tahunInput"
                           placeholder="Contoh: 2024"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 text-gray-900
                                  focus:ring-2 focus:ring-maroon focus:border-maroon
                                  outline-none transition font-mono">
                    <p class="text-xs text-gray-500 mt-1">Masukkan tahun ajaran (contoh: 2024)</p>
                    @error('tahun')
                        <p class="text-red-500 text-xs mt-1 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- NOMINAL KATEGORI -->
                <div class="space-y-4">
                    <h4 class="text-sm font-medium text-gray-700 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Nominal Biaya per Kategori
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @foreach(['normal' => 'Normal', 'kip' => 'KIP', 'yatim' => 'Yatim/Piatu'] as $key => $label)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <span class="flex items-center gap-2">
                                    @if($key == 'normal')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                    @elseif($key == 'kip')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                        </svg>
                                    @endif
                                    {{ $label }}
                                </span>
                            </label>
                            <input type="number" name="{{ $key }}" value="{{ old($key) }}" required
                                   placeholder="0"
                                   class="w-full px-4 py-2 rounded-lg border border-gray-300 text-gray-900
                                          focus:ring-2 focus:ring-maroon focus:border-maroon
                                          outline-none transition font-mono">
                            @error($key)
                                <p class="text-red-500 text-xs mt-1 flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- INFO -->
                <div class="bg-blue-50 border border-blue-200 p-4 rounded-lg">
                    <div class="flex items-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <p class="text-sm text-blue-800 font-medium">Informasi:</p>
                            <ul class="text-sm text-blue-700 mt-1 space-y-1">
                                <li>• Normal: Biaya standar untuk siswa reguler</li>
                                <li>• KIP: Biaya untuk siswa penerima Kartu Indonesia Pintar</li>
                                <li>• Yatim/Piatu: Biaya khusus untuk siswa yatim piatu</li>
                                <li>• Tahun yang sudah ada tidak dapat ditambahkan kembali</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- VALIDATION DUPLICATE -->
                <div id="duplicateWarning" class="hidden bg-red-50 border border-red-200 text-red-700 p-4 rounded-lg">
                    <div class="flex items-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <p class="font-medium text-sm">Tahun sudah ada!</p>
                            <p class="text-sm mt-1">SPP untuk tahun ini sudah terdaftar. Silakan gunakan tahun yang berbeda.</p>
                        </div>
                    </div>
                </div>

                <!-- TOMBOL AKSI -->
                <div class="flex gap-3 pt-4 border-t border-gray-200">
                    <a href="{{ route('spp.index') }}" 
                       class="flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-300 text-gray-700
                              hover:bg-gray-50 transition font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Batal
                    </a>
                    <button type="submit" id="submitBtn"
                            class="flex-1 flex items-center justify-center gap-2 px-4 py-2 rounded-lg
                                   bg-maroon text-white hover:bg-maroonLight transition font-semibold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan SPP
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>

<script>
// Get existing years from server
const existingYears = @json(\App\Models\Spp::pluck('tahun')->toArray());

document.getElementById('sppForm').addEventListener('submit', function(e) {
    const tahunInput = document.getElementById('tahunInput');
    const tahun = parseInt(tahunInput.value);
    const duplicateWarning = document.getElementById('duplicateWarning');
    const submitBtn = document.getElementById('submitBtn');
    
    // Check if year already exists
    if (existingYears.includes(tahun)) {
        e.preventDefault();
        
        // Show duplicate warning
        duplicateWarning.classList.remove('hidden');
        submitBtn.disabled = true;
        submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
        
        // Focus on year input and add red border
        tahunInput.focus();
        tahunInput.classList.add('border-red-500');
    }
});

// Remove error styling when user starts typing
document.getElementById('tahunInput').addEventListener('input', function() {
    this.classList.remove('border-red-500');
    const duplicateWarning = document.getElementById('duplicateWarning');
    const submitBtn = document.getElementById('submitBtn');
    
    // Hide duplicate warning
    duplicateWarning.classList.add('hidden');
    submitBtn.disabled = false;
    submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
});
</script>

@endsection
