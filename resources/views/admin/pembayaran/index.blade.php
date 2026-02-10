@extends('layout.admin')

@section('title', 'History Pembayaran')

@section('content')

<!-- HEADER -->
<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold text-gray-800">History Pembayaran</h2>
    <a href="{{ route('admin.pembayaran.excel', request()->query()) }}"
       class="bg-green-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-green-700 transition shadow-md text-sm flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
        </svg>
        Export Excel
    </a>
</div>

<!-- FILTER -->
<div class="bg-white p-4 rounded-lg shadow-md border border-gray-100 mb-6">
    <form method="GET" action="{{ route('admin.pembayaran.index') }}" class="flex flex-wrap gap-3 items-center">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
            <select name="kelas" class="border border-gray-300 text-gray-700 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-maroon focus:border-maroon">
                <option value="">-- Semua Kelas --</option>
                @foreach($listKelas as $k)
                    <option value="{{ $k }}" {{ request('kelas') == $k ? 'selected' : '' }}>{{ $k }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Bulan</label>
            <select name="bulan" class="border border-gray-300 text-gray-700 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-maroon focus:border-maroon">
                <option value="">-- Semua Bulan --</option>
                @foreach (['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $b)
                    <option value="{{ $b }}" {{ request('bulan') == $b ? 'selected' : '' }}>{{ $b }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Tahun</label>
            <select name="tahun" class="border border-gray-300 text-gray-700 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-maroon focus:border-maroon">
                <option value="">-- Semua Tahun --</option>
                @for ($i = 2020; $i <= date('Y'); $i++)
                    <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </div>

        <div class="flex gap-2 items-end">
            <button type="submit" class="bg-maroon text-white px-4 py-2 rounded-lg hover:bg-maroonLight transition font-semibold">
                Filter
            </button>
            <a href="{{ route('admin.pembayaran.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition font-semibold">
                Reset
            </a>
        </div>
    </form>
</div>

<!-- TABLE -->
<div class="bg-white rounded-lg shadow-md border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="p-4 font-medium text-gray-700">No</th>
                    <th class="p-4 font-medium text-gray-700">Siswa</th>
                    <th class="p-4 font-medium text-gray-700">Kelas</th>
                    <th class="p-4 font-medium text-gray-700">Bulan</th>
                    <th class="p-4 font-medium text-gray-700">Tahun</th>
                    <th class="p-4 font-medium text-gray-700">Nominal</th>
                    <th class="p-4 font-medium text-gray-700">Petugas</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($data as $p)
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-4 text-gray-900">{{ $loop->iteration }}</td>
                    <td class="p-4">
                        <div class="font-medium text-gray-900">{{ $p->siswa->nama }}</div>
                        <div class="text-xs text-gray-500">NISN: {{ $p->siswa->nisn }}</div>
                    </td>
                    <td class="p-4 text-gray-900">{{ $p->siswa->kelas->nama_kelas }}</td>
                    <td class="p-4 text-gray-900">{{ $p->bulan_dibayar }}</td>
                    <td class="p-4 text-gray-900">{{ $p->tahun_dibayar }}</td>
                    <td class="p-4">
                        <span class="font-semibold text-green-600">Rp {{ number_format($p->spp->nominal,0,',','.') }}</span>
                    </td>
                    <td class="p-4 text-gray-900">{{ $p->petugas->nama ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="p-8 text-center text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Data pembayaran tidak tersedia.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
