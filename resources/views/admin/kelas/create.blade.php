@extends('layout.admin')

@section('title', 'Tambah Kelas')

@section('content')

<!-- HEADER -->
<div class="mb-8">
    <div class="flex items-center gap-3 text-sm text-gray-600 mb-4">
        <a href="{{ url('/admin/kelas') }}" class="hover:text-maroon transition flex items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Data Kelas
        </a>
        <span>/</span>
        <span class="text-gray-900 font-medium">Tambah Kelas</span>
    </div>
    <h2 class="text-2xl font-bold text-gray-800">Tambah Kelas Baru</h2>
    <p class="text-gray-600 text-sm mt-1">Tambahkan data kelas dan kompetensi keahlian baru</p>
</div>

<div class="max-w-2xl mx-auto">

    <!-- FORM CARD -->
    <div class="bg-white rounded-lg shadow-md border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-maroon to-maroonLight p-6">
            <h3 class="text-white font-semibold flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Formulir Kelas Baru
            </h3>
        </div>

        <div class="p-6">
            <form action="/admin/kelas" method="POST" class="space-y-6">
                @csrf

                <!-- ERROR VALIDASI -->
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

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- NAMA KELAS -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <span class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                Nama Kelas
                            </span>
                        </label>
                        <input type="text" name="nama_kelas" placeholder="Contoh: X RPL 1" required
                            value="{{ old('nama_kelas') }}"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 text-gray-900
                                   focus:ring-2 focus:ring-maroon focus:border-maroon
                                   outline-none transition">
                        <p class="text-xs text-gray-500 mt-1">Format: Tingkat Jurusan Nomor (contoh: X RPL 1)</p>
                    </div>

                    <!-- KOMPETENSI KEAHLIAN -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <span class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                </svg>
                                Kompetensi Keahlian
                            </span>
                        </label>
                        <input type="text" name="kompetensi_keahlian" placeholder="Contoh: Rekayasa Perangkat Lunak" required
                            value="{{ old('kompetensi_keahlian') }}"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 text-gray-900
                                   focus:ring-2 focus:ring-maroon focus:border-maroon
                                   outline-none transition">
                        <p class="text-xs text-gray-500 mt-1">Nama lengkap program keahlian</p>
                    </div>
                </div>

                <!-- TIPS -->
                <div class="bg-blue-50 border border-blue-200 p-4 rounded-lg">
                    <div class="flex items-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <p class="text-sm text-blue-800 font-medium">Tips:</p>
                            <ul class="text-sm text-blue-700 mt-1 space-y-1">
                                <li>• Gunakan format standar untuk nama kelas</li>
                                <li>• Pastikan kompetensi keahlian sesuai kurikulum</li>
                                <li>• Data kelas akan digunakan untuk mengelompokkan siswa</li>
                                <li>• Kelas dengan nama dan kompetensi yang sama tidak dapat ditambahkan</li>
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
                            <p class="font-medium text-sm">Kelas sudah ada!</p>
                            <p class="text-sm mt-1">Kelas dengan nama dan kompetensi keahlian yang sama sudah terdaftar. Silakan gunakan nama atau kompetensi yang berbeda.</p>
                        </div>
                    </div>
                </div>

                <!-- TOMBOL AKSI -->
                <div class="flex gap-3 pt-4 border-t border-gray-200">
                    <a href="{{ url('/admin/kelas') }}" 
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
                        Simpan Kelas
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const namaKelasInput = document.querySelector('input[name="nama_kelas"]');
    const kompetensiInput = document.querySelector('input[name="kompetensi_keahlian"]');
    const submitBtn = document.getElementById('submitBtn');
    const duplicateWarning = document.getElementById('duplicateWarning');
    
    // List of existing classes (you can get this from server or hardcode for now)
    const existingClasses = @json(\App\Models\Kelas::pluck('nama_kelas', 'kompetensi_keahlian')->toArray());
    
    function checkDuplicate() {
        const namaKelas = namaKelasInput.value.trim();
        const kompetensi = kompetensiInput.value.trim();
        
        if (namaKelas && kompetensi) {
            // Check if exact combination exists
            const isDuplicate = Object.entries(existingClasses).some(([key, value]) => {
                return key === kompetensi && value === namaKelas;
            });
            
            if (isDuplicate) {
                duplicateWarning.classList.remove('hidden');
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
                return false;
            } else {
                duplicateWarning.classList.add('hidden');
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                return true;
            }
        } else {
            duplicateWarning.classList.add('hidden');
            submitBtn.disabled = false;
            submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            return true;
        }
    }
    
    // Add event listeners
    namaKelasInput.addEventListener('input', checkDuplicate);
    kompetensiInput.addEventListener('input', checkDuplicate);
    
    // Prevent form submission if duplicate
    form.addEventListener('submit', function(e) {
        if (!checkDuplicate()) {
            e.preventDefault();
            return false;
        }
    });
    
    // Initial check
    checkDuplicate();
});
</script>

@endsection
