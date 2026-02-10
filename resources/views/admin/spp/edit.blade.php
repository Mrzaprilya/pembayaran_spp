@extends('layout.admin')

@section('title','Edit SPP')

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
        <span class="text-gray-900 font-medium">Edit SPP</span>
    </div>
    <h2 class="text-2xl font-bold text-gray-800">Edit Data SPP</h2>
    <p class="text-gray-600 text-sm mt-1">Perbarui Standar Biaya Pendidikan tahun {{ $tahun }}</p>
</div>

<div class="max-w-2xl mx-auto">

    <!-- FORM CARD -->
    <div class="bg-white rounded-lg shadow-md border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-maroon to-maroonLight p-6">
            <h3 class="text-white font-semibold flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Formulir SPP
            </h3>
        </div>

        <div class="p-6">
            <!-- STATUS PEMBAYARAN -->
            @php
                $hasPayments = \App\Models\Pembayaran::whereHas('spp', function($query) use ($tahun) {
                    $query->where('tahun', $tahun);
                })->exists();
            @endphp

            @if($hasPayments)
            <div class="bg-amber-50 border border-amber-200 p-4 rounded-lg mb-6">
                <div class="flex items-start gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                    <div>
                        <p class="text-sm text-amber-800 font-medium">Status Pembayaran:</p>
                        <p class="text-sm text-amber-700 mt-1">Terdapat pembayaran yang sudah menggunakan SPP tahun {{ $tahun }}.</p>
                        <p class="text-sm text-amber-700 mt-1">Perubahan nominal akan berlaku untuk pembayaran bulan berikutnya.</p>
                    </div>
                </div>
            </div>
            @else
            <div class="bg-green-50 border border-green-200 p-4 rounded-lg mb-6">
                <div class="flex items-start gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <p class="text-sm text-green-800 font-medium">Status Pembayaran:</p>
                        <p class="text-sm text-green-700 mt-1">Belum ada pembayaran untuk SPP tahun {{ $tahun }}.</p>
                        <p class="text-sm text-green-700 mt-1">Perubahan nominal akan langsung berlaku.</p>
                    </div>
                </div>
            </div>
            @endif

            <form action="{{ route('spp.update', $tahun) }}" method="POST" class="space-y-6">
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
                    <input type="number" name="tahun"
                           value="{{ old('tahun', $tahun) }}"
                           required
                           readonly
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 bg-gray-50 text-gray-600
                                  font-mono cursor-not-allowed">
                    <p class="text-xs text-gray-500 mt-1">Tahun ajaran tidak dapat diubah</p>
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
                        <!-- NORMAL -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <span class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                    Normal
                                </span>
                            </label>
                            <div class="relative">
                                <input type="number" name="normal"
                                       value="{{ old('normal', $data['normal']['nominal'] ?? '') }}"
                                       required
                                       placeholder="0"
                                       class="w-full px-4 py-2 rounded-lg border border-gray-300 text-gray-900
                                              focus:ring-2 focus:ring-maroon focus:border-maroon
                                              outline-none transition font-mono">
                                @if($hasPayments)
                                <div class="absolute -top-2 -right-2 bg-amber-500 text-white text-xs px-2 py-1 rounded-full">
                                    Baru
                                </div>
                                @endif
                            </div>
                            @error('normal')
                                <p class="text-red-500 text-xs mt-1 flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- KIP -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <span class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                    KIP
                                </span>
                            </label>
                            <div class="relative">
                                <input type="number" name="kip"
                                       value="{{ old('kip', $data['kip']['nominal'] ?? '') }}"
                                       required
                                       placeholder="0"
                                       class="w-full px-4 py-2 rounded-lg border border-gray-300 text-gray-900
                                              focus:ring-2 focus:ring-maroon focus:border-maroon
                                              outline-none transition font-mono">
                                @if($hasPayments)
                                <div class="absolute -top-2 -right-2 bg-amber-500 text-white text-xs px-2 py-1 rounded-full">
                                    Baru
                                </div>
                                @endif
                            </div>
                            @error('kip')
                                <p class="text-red-500 text-xs mt-1 flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- YATIM -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <span class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                    Yatim/Piatu
                                </span>
                            </label>
                            <div class="relative">
                                <input type="number" name="yatim"
                                       value="{{ old('yatim', $data['yatim']['nominal'] ?? '') }}"
                                       required
                                       placeholder="0"
                                       class="w-full px-4 py-2 rounded-lg border border-gray-300 text-gray-900
                                              focus:ring-2 focus:ring-maroon focus:border-maroon
                                              outline-none transition font-mono">
                                @if($hasPayments)
                                <div class="absolute -top-2 -right-2 bg-amber-500 text-white text-xs px-2 py-1 rounded-full">
                                    Baru
                                </div>
                                @endif
                            </div>
                            @error('yatim')
                                <p class="text-red-500 text-xs mt-1 flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- INFO KEBIJAKAN UPDATE -->
                <div class="bg-blue-50 border border-blue-200 p-4 rounded-lg">
                    <div class="flex items-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <p class="text-sm text-blue-800 font-medium">Kebijakan Update SPP:</p>
                            @if($hasPayments)
                                <ul class="text-sm text-blue-700 mt-1 space-y-1">
                                    <li>• Nominal lama tetap berlaku untuk pembayaran yang sudah dilakukan</li>
                                    <li>• Nominal baru akan berlaku untuk pembayaran mulai besok</li>
                                    <li>• Sistem akan otomatis menggunakan nominal yang sesuai berdasarkan tanggal</li>
                                </ul>
                            @else
                                <ul class="text-sm text-blue-700 mt-1 space-y-1">
                                    <li>• Nominal baru akan langsung berlaku untuk semua pembayaran</li>
                                    <li>• Belum ada pembayaran yang menggunakan SPP tahun ini</li>
                                    <li>• Perubahan akan mempengaruhi seluruh perhitungan pembayaran</li>
                                </ul>
                            @endif
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
                    <button type="submit"
                            class="flex-1 flex items-center justify-center gap-2 px-4 py-2 rounded-lg
                                   bg-maroon text-white hover:bg-maroonLight transition font-semibold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Update SPP
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>

@endsection