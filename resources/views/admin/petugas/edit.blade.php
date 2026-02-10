@extends('layout.admin')

@section('title', 'Edit Petugas')

@section('content')

<!-- HEADER -->
<div class="mb-8">
    <div class="flex items-center gap-3 text-sm text-gray-600 mb-4">
        <a href="{{ url('/admin/petugas') }}" class="hover:text-maroon transition flex items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Data Petugas
        </a>
        <span>/</span>
        <span class="text-gray-900 font-medium">Edit Petugas</span>
    </div>
    <h2 class="text-2xl font-bold text-gray-800">Edit Data Petugas</h2>
    <p class="text-gray-600 text-sm mt-1">Perbarui informasi petugas: {{ $petugas->nama }}</p>
</div>

<div class="max-w-2xl mx-auto">

    <!-- FORM CARD -->
    <div class="bg-white rounded-lg shadow-md border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-maroon to-maroonLight p-6">
            <h3 class="text-white font-semibold flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Formulir Petugas
            </h3>
        </div>

        <div class="p-6">
            <form action="{{ url('/admin/petugas/'.$petugas->id) }}" method="POST" class="space-y-6">
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
                    <!-- NAMA -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <span class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Nama Lengkap
                            </span>
                        </label>
                        <input type="text" name="nama" required
                            value="{{ old('nama', $petugas->nama) }}"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 text-gray-900
                                   focus:ring-2 focus:ring-maroon focus:border-maroon
                                   outline-none transition">
                    </div>

                    <!-- NO TELP -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <span class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                No. Telepon
                            </span>
                        </label>
                        <input type="text" name="no_telp" required
                            value="{{ old('no_telp', $petugas->no_telp) }}"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 text-gray-900
                                   focus:ring-2 focus:ring-maroon focus:border-maroon
                                   outline-none transition">
                    </div>

                    <!-- USERNAME -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <span class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Username
                            </span>
                        </label>
                        <input type="text" name="username" required
                            value="{{ old('username', $petugas->username) }}"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 text-gray-900
                                   focus:ring-2 focus:ring-maroon focus:border-maroon
                                   outline-none transition font-mono">
                    </div>

                    <!-- PASSWORD -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <span class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                                Password
                            </span>
                        </label>
                        <input type="password" name="password" 
                            placeholder="Kosongkan jika tidak diubah"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 text-gray-900
                                   focus:ring-2 focus:ring-maroon focus:border-maroon
                                   outline-none transition">
                        <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah password</p>
                    </div>

                    <!-- LEVEL -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <span class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                                Level Akses
                            </span>
                        </label>
                        <select name="level" required
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 text-gray-900
                                   focus:ring-2 focus:ring-maroon focus:border-maroon
                                   outline-none transition">
                            <option value="">-- Pilih Level --</option>
                            <option value="admin" {{ old('level', $petugas->level) == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="petugas" {{ old('level', $petugas->level) == 'petugas' ? 'selected' : '' }}>Petugas</option>
                        </select>
                    </div>
                </div>

                <!-- TOMBOL AKSI -->
                <div class="flex gap-3 pt-4 border-t border-gray-200">
                    <a href="{{ url('/admin/petugas') }}" 
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
                        Update Petugas
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>

@endsection
