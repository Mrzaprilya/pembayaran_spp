@extends('layout.admin')

@section('content')

<!-- HEADER -->
<div class="mb-8">
    <h2 class="text-2xl font-bold text-gray-800">
        Dashboard Admin
    </h2>
    <p class="text-gray-600 text-sm mt-1">
        Ringkasan sistem pembayaran SPP
    </p>
</div>

<!-- CARD STATISTIK -->
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6 mb-10">

    <!-- TOTAL SISWA -->
    <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Total Siswa</p>
                <p class="text-3xl font-bold text-maroon mt-2">
                    {{ $totalSiswa }}
                </p>
            </div>
            <div class="bg-maroon/10 p-3 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-maroon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- TOTAL PETUGAS -->
    <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Total Petugas</p>
                <p class="text-3xl font-bold text-maroon mt-2">
                    {{ $totalPetugas }}
                </p>
            </div>
            <div class="bg-gold/10 p-3 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 1118.803 5.121 9 9 0 015.121 17.804zM15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- PEMASUKAN -->
    <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">
                    @if(request('bulan'))
                        Pemasukan {{ request('bulan') }} {{ request('tahun', now()->year) }}
                    @else
                        Total Pemasukan {{ request('tahun', now()->year) }}
                    @endif
                </p>
                <p class="text-2xl font-bold text-green-600 mt-2">
                    Rp {{ number_format($pemasukanBulanIni,0,',','.') }}
                </p>
            </div>
            <div class="bg-green-100 p-3 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
    </div>

</div>

<!-- STATISTIK PEMASUKAN -->
<div class="bg-white p-6 rounded-xl shadow-md border border-gray-100 mb-10">
    <div class="flex justify-between items-center mb-6">
        <h3 class="font-semibold text-gray-800 text-lg">Statistik Pemasukan</h3>

        <!-- DROPDOWN TAHUN DAN BULAN -->
        <div class="flex gap-2">
            <!-- DROPDOWN TAHUN -->
            <select 
                onchange="location.href='?tahun='+this.value+'&bulan={{ request('bulan') }}'"
                class="border border-gray-300 text-gray-700 px-3 py-2 rounded-lg shadow-sm
                       focus:outline-none focus:ring-2 focus:ring-maroon focus:border-maroon">
                @foreach($availableYears as $year)
                    <option value="{{ $year }}" {{ request('tahun', now()->year) == $year ? 'selected' : '' }}>
                        {{ $year }}
                    </option>
                @endforeach
            </select>
            
            <!-- DROPDOWN BULAN -->
            <select 
                onchange="location.href='?tahun={{ request('tahun', now()->year) }}&bulan='+this.value"
                class="border border-gray-300 text-gray-700 px-3 py-2 rounded-lg shadow-sm
                       focus:outline-none focus:ring-2 focus:ring-maroon focus:border-maroon">
                <option value="">Semua Bulan</option>
                @foreach([
                    'Januari','Februari','Maret','April','Mei','Juni',
                    'Juli','Agustus','September','Oktober','November','Desember'
                ] as $b)
                    <option value="{{ $b }}" {{ request('bulan') == $b ? 'selected' : '' }}>
                        {{ $b }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="py-3 px-4 text-left font-medium text-gray-700">Bulan</th>
                    <th class="py-3 px-4 text-left font-medium text-gray-700">Total</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($statistik as $s)
                <tr class="hover:bg-gray-50">
                    <td class="py-3 px-4 text-gray-900">{{ $s->bulan }}</td>
                    <td class="py-3 px-4 font-semibold text-gray-900">Rp {{ number_format($s->total,0,',','.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="2" class="py-8 text-center text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        Tidak ada data pemasukan untuk tahun {{ request('tahun', now()->year) }}
                        @if(request('bulan')) - bulan {{ request('bulan') }} @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- PEMBAYARAN TERBARU -->
<div class="bg-white p-6 rounded-xl shadow-md border border-gray-100">
    <h3 class="font-semibold text-gray-800 text-lg mb-6">Pembayaran Terbaru</h3>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="py-3 px-4 text-left font-medium text-gray-700">Siswa</th>
                    <th class="py-3 px-4 text-left font-medium text-gray-700">Bulan</th>
                    <th class="py-3 px-4 text-left font-medium text-gray-700">Tahun</th>
                    <th class="py-3 px-4 text-left font-medium text-gray-700">Jumlah</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($pembayaranTerbaru as $p)
                <tr class="hover:bg-gray-50">
                    <td class="py-3 px-4">
                        <div class="font-medium text-gray-900">{{ $p->siswa->nama }}</div>
                        <div class="text-xs text-gray-500">{{ $p->siswa->kelas->nama_kelas ?? '-' }}</div>
                    </td>
                    <td class="py-3 px-4 text-gray-900">{{ $p->bulan_dibayar }}</td>
                    <td class="py-3 px-4 text-gray-900">{{ $p->tahun_dibayar }}</td>
                    <td class="py-3 px-4">
                        <span class="font-semibold text-green-600">Rp {{ number_format($p->jumlah_bayar,0,',','.') }}</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
