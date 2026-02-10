@extends('layout.admin')

@section('title', 'Edit Siswa')

@section('content')

<!-- HEADER -->
<div class="mb-8">
    <div class="flex items-center gap-3 text-sm text-gray-600 mb-4">
        <a href="{{ route('siswa.index') }}" class="hover:text-maroon transition flex items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Data Siswa
        </a>
        <span>/</span>
        <span class="text-gray-900 font-medium">Edit Siswa</span>
    </div>
    <h2 class="text-2xl font-bold text-gray-800">Edit Data Siswa</h2>
    <p class="text-gray-600 text-sm mt-1">Perbarui informasi siswa: {{ $siswa->nama }}</p>
</div>

<div class="max-w-3xl mx-auto">

    <!-- FORM CARD -->
    <div class="bg-white rounded-lg shadow-md border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-maroon to-maroonLight p-6">
            <h3 class="text-white font-semibold flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Formulir Siswa
            </h3>
        </div>

        <div class="p-6">
            <form action="{{ route('siswa.update', $siswa->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

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

                    <!-- NISN -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <span class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                                </svg>
                                NISN
                                <span class="text-red-500">*</span>
                            </span>
                        </label>
                        <input type="text" name="nisn" value="{{ $siswa->nisn }}" maxlength="10"
                               placeholder="Masukkan 10 digit NISN"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 text-gray-900
                                      focus:ring-2 focus:ring-maroon focus:border-maroon
                                      outline-none transition font-mono"
                               required>
                        <p class="text-xs text-gray-500 mt-1">Nomor Induk Siswa Nasional (10 digit)</p>
                    </div>

                    <!-- NIS -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <span class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                                </svg>
                                NIS
                                <span class="text-red-500">*</span>
                            </span>
                        </label>
                        <input type="text" name="nis" value="{{ $siswa->nis }}"
                               placeholder="Masukkan NIS sekolah"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 text-gray-900
                                      focus:ring-2 focus:ring-maroon focus:border-maroon
                                      outline-none transition font-mono"
                               required>
                        <p class="text-xs text-gray-500 mt-1">Nomor Induk Sekolah</p>
                    </div>

                    <!-- NAMA -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <span class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Nama Lengkap
                                <span class="text-red-500">*</span>
                            </span>
                        </label>
                        <input type="text" name="nama" value="{{ $siswa->nama }}"
                               placeholder="Masukkan nama lengkap siswa"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 text-gray-900
                                      focus:ring-2 focus:ring-maroon focus:border-maroon
                                      outline-none transition"
                               required>
                        <p class="text-xs text-gray-500 mt-1">Nama lengkap sesuai dokumen resmi</p>
                    </div>

                    <!-- KELAS -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <span class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                Kelas
                                <span class="text-red-500">*</span>
                            </span>
                        </label>
                        <select name="kelas_id" required
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 text-gray-900
                                       focus:ring-2 focus:ring-maroon focus:border-maroon
                                       outline-none transition">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($kelas as $k)
                                <option value="{{ $k->id }}" {{ $siswa->kelas_id == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kelas }} - {{ $k->kompetensi_keahlian }}
                                </option>
                            @endforeach
                        </select>
                        <p class="text-xs text-gray-500 mt-1">Pilih kelas dan kompetensi keahlian</p>
                    </div>

                    <!-- SPP -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <span class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Kategori SPP
                                <span class="text-red-500">*</span>
                            </span>
                        </label>
                        <select name="spp_id" required
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 text-gray-900
                                       focus:ring-2 focus:ring-maroon focus:border-maroon
                                       outline-none transition">
                            <option value="">-- Pilih SPP --</option>
                            @php
                                // Group SPP by year and get the most recent active one for each category
                                $sppGrouped = [];
                                foreach($spp as $sp) {
                                    $key = $sp->tahun . '_' . $sp->kategori;
                                    if (!isset($sppGrouped[$key]) || 
                                        ($sp->is_active && $sp->tanggal_berlaku && $sp->tanggal_berlaku <= now()) ||
                                        (!$sppGrouped[$key]->is_active && $sp->is_active)) {
                                        $sppGrouped[$key] = $sp;
                                    }
                                }
                            @endphp
                            @foreach($sppGrouped as $sp)
                                <option value="{{ $sp->id }}" {{ old('spp_id', $siswa->spp_id ?? '') == $sp->id ? 'selected' : '' }}>
                                    {{ $sp->tahun }} - {{ ucfirst($sp->kategori) }} - Rp {{ number_format($sp->nominal,0,',','.') }}
                                </option>
                            @endforeach
                        </select>
                        <p class="text-xs text-gray-500 mt-1">Pilih kategori SPP yang berlaku (nominal terbaru)</p>
                    </div>

                    <!-- ALAMAT -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <span class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                Alamat Lengkap
                                <span class="text-red-500">*</span>
                            </span>
                        </label>
                        <textarea name="alamat" rows="3" required
                                  placeholder="Masukkan alamat lengkap siswa"
                                  class="w-full px-4 py-2 rounded-lg border border-gray-300 text-gray-900
                                         focus:ring-2 focus:ring-maroon focus:border-maroon
                                         outline-none transition resize-none">{{ $siswa->alamat }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Alamat tempat tinggal siswa</p>
                    </div>

                    <!-- NO TELP -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <span class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                Nomor Telepon
                                <span class="text-red-500">*</span>
                            </span>
                        </label>
                        <input type="text" name="no_telp" value="{{ $siswa->no_telp }}"
                               placeholder="Contoh: 08123456789"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 text-gray-900
                                      focus:ring-2 focus:ring-maroon focus:border-maroon
                                      outline-none transition font-mono"
                               required>
                        <p class="text-xs text-gray-500 mt-1">Nomor telepon orang tua/wali siswa</p>
                    </div>

                </div>

                <!-- INFO -->
                <div class="bg-amber-50 border border-amber-200 p-4 rounded-lg">
                    <div class="flex items-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                        </svg>
                        <div>
                            <p class="text-sm text-amber-800 font-medium">Perhatian:</p>
                            <ul class="text-sm text-amber-700 mt-1 space-y-1">
                                <li>• Perubahan data akan mempengaruhi seluruh sistem</li>
                                <li>• Pastikan NISN dan NIS sudah benar sebelum menyimpan</li>
                                <li>• Perubahan kelas dapat mempengaruhi penempatan siswa</li>
                                <li>• Data pembayaran akan tetap menggunakan SPP yang dipilih</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- TOMBOL AKSI -->
                <div class="flex gap-3 pt-4 border-t border-gray-200">
                    <a href="{{ route('siswa.index') }}" 
                       class="flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-300 text-gray-700
                              hover:bg-gray-50 transition font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Batal
                    </a>
                    <button type="submit"
                            class="flex-1 flex items-center justify-center gap-2 px-4 py-2 rounded-lg
                                   bg-maroon text-white hover:bg-maroonLight transition font-semibold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Update Data Siswa
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>

@endsection
