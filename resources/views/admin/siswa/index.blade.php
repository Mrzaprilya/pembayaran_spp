@extends('layout.admin')

@section('title', 'Data Siswa')

@section('content')

<!-- HEADER -->
<div class="mb-8">
    <div class="flex justify-between items-start mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Data Siswa</h2>
            <p class="text-gray-600 text-sm mt-1">Kelola data siswa yang terdaftar di sistem</p>
        </div>
        <a href="{{ route('siswa.create') }}" 
           class="flex items-center gap-2 bg-maroon text-white px-4 py-2 rounded-lg
                  hover:bg-maroonLight transition font-semibold shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Siswa
        </a>
    </div>

    <!-- STATISTICS -->
    <div class="flex items-center gap-2 text-sm text-gray-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
        </svg>
        Total {{ count($data) }} siswa terdaftar
    </div>
</div>

<!-- SUCCESS MESSAGE -->
@if(session('success'))
<div class="bg-green-50 border border-green-200 text-green-700 p-4 rounded-lg mb-6">
    <div class="flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <span class="text-sm font-medium">{{ session('success') }}</span>
    </div>
</div>
@endif

<!-- TABLE CARD -->
<div class="bg-white rounded-lg shadow-md border border-gray-100 overflow-hidden">
    <div class="bg-gradient-to-r from-maroon to-maroonLight p-6">
        <h3 class="text-white font-semibold flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            Tabel Data Siswa
        </h3>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NISN</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SPP</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Telp</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($data as $s)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $loop->iteration }}
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900 font-mono">
                        {{ $s->nisn }}
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap">
                        <div class="flex items-center gap-2">
                            <div class="h-6 w-6 rounded-full bg-maroon flex items-center justify-center">
                                <span class="text-white text-xs font-semibold">{{ strtoupper(substr($s->nama, 0, 1)) }}</span>
                            </div>
                            <div class="text-sm font-medium text-gray-900">{{ $s->nama }}</div>
                        </div>
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap">
                        <div class="text-xs">
                            <div class="font-medium text-gray-900">{{ $s->kelas->nama_kelas }}</div>
                            <div class="text-gray-500">{{ $s->kelas->kompetensi_keahlian }}</div>
                        </div>
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap">
                        @php
                            // Get the most recent active SPP for this student's year and category
                            $activeSpp = \App\Models\Spp::where('tahun', $s->spp->tahun ?? date('Y'))
                                ->where('kategori', $s->spp->kategori ?? 'normal')
                                ->where('is_active', true)
                                ->orderBy('tanggal_berlaku', 'desc')
                                ->first();
                        @endphp
                        @if($activeSpp)
                            <div class="space-y-1">
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium 
                                    @if($activeSpp->kategori == 'normal') bg-green-100 text-green-800
                                    @elseif($activeSpp->kategori == 'kip') bg-blue-100 text-blue-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($activeSpp->kategori) }}
                                </span>
                                <div class="text-xs text-gray-600 font-mono">
                                    Rp {{ number_format($activeSpp->nominal, 0, ',', '.') }}
                                </div>
                            </div>
                        @else
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                Belum ada SPP
                            </span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-600 max-w-xs truncate">
                        {{ $s->alamat }}
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900 font-mono">
                        {{ $s->no_telp }}
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap text-center">
                        <div class="flex justify-center gap-1">
                            <a href="{{ route('siswa.edit', $s->id) }}"
                               class="inline-flex items-center gap-1 px-2 py-1 rounded text-xs font-medium
                                      bg-blue-50 text-blue-700 border border-blue-200
                                      hover:bg-blue-100 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit
                            </a>

                            <form action="{{ route('siswa.destroy', $s->id) }}" method="POST"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus data siswa {{ $s->nama }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center gap-1 px-2 py-1 rounded text-xs font-medium
                                               bg-red-50 text-red-700 border border-red-200
                                               hover:bg-red-100 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-6 py-12">
                        <div class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada data siswa</h3>
                            <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan siswa pertama.</p>
                            <div class="mt-6">
                                <a href="{{ route('siswa.create') }}" 
                                   class="inline-flex items-center gap-2 px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-maroon hover:bg-maroonLight focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-maroon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                    Tambah Siswa Pertama
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
