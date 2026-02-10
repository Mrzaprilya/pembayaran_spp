@extends('layout.petugas')

@section('content')

<!-- PERSONALIZED GREETING -->
<div class="bg-gradient-to-r from-maroon to-maroonLight rounded-xl shadow-lg p-6 mb-6 text-white">
    <h2 class="text-2xl font-bold mb-2">
        Halo, {{ session('nama') }}! 👋
    </h2>
    <p class="text-sm opacity-90">
        Selamat datang di dashboard Petugas SPP
    </p>
</div>

<h3 class="text-xl font-semibold text-maroon mb-6">
    Dashboard Overview
</h3>

<!-- FILTER BULAN & TAHUN -->
<form method="GET" class="flex flex-wrap gap-3 mb-8">
    <select name="bulan"
        class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-gold">
        @foreach ($bulanList as $b)
            <option value="{{ $b }}" {{ $bulan == $b ? 'selected' : '' }}>
                {{ $b }}
            </option>
        @endforeach
    </select>

    <select name="tahun"
        class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-gold">
        @for ($i = 2020; $i <= date('Y'); $i++)
            <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>
                {{ $i }}
            </option>
        @endfor
    </select>

    <div class="flex justify-end">
    <button
        class="px-4 py-2 bg-maroon text-gold rounded-lg hover:bg-maroonLight transition">
        Tampilkan
    </button>
</div>
</form>

<!-- CARD DASHBOARD -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

    <!-- HARI INI -->
    <div class="bg-gray-50 p-6 rounded-xl shadow">
        <p class="text-gray-500 text-sm">Pembayaran Hari Ini</p>
        <p class="text-3xl font-bold text-maroon">{{ $hariIni }}</p>
        <p class="text-xs text-gray-400 mt-2">
            Transaksi yang terjadi hari ini
        </p>
    </div>

    <!-- TOTAL SISWA -->
    <div class="bg-gray-50 p-6 rounded-xl shadow">
        <p class="text-gray-500 text-sm">Total Siswa</p>
        <p class="text-3xl font-bold text-maroon">{{ $totalSiswa }}</p>
        <p class="text-xs text-gray-400 mt-2">
            Jumlah seluruh siswa terdaftar
        </p>
    </div>

    <!-- PENDAPATAN BULAN INI -->
    <div class="bg-green-50 p-6 rounded-xl shadow border border-green-200">
        <p class="text-green-600 text-sm font-semibold">Pendapatan Bulan Ini</p>
        <p class="text-3xl font-bold text-green-600">
            Rp {{ number_format($pendapatanBulanIni,0,',','.') }}
        </p>
        <p class="text-xs text-green-500 mt-2">
            Total pendapatan {{ $bulanList[date('n') - 1] }} {{ date('Y') }}
        </p>
    </div>

    <!-- BULAN DIPILIH -->
    <div class="bg-blue-50 p-6 rounded-xl shadow border border-blue-200">
        <p class="text-blue-600 text-sm font-semibold">
            Total Pembayaran {{ $bulan }} {{ $tahun }}
        </p>
        <p class="text-3xl font-bold text-blue-600">
            Rp {{ number_format($totalPembayaranBulan,0,',','.') }}
        </p>
        <p class="text-xs text-blue-500 mt-2">
            {{ $transaksiBulan }} transaksi pada bulan tersebut
        </p>
    </div>

</div>

<!-- INFORMASI -->
<div class="bg-maroon/5 border border-maroon/20 p-6 rounded-xl">
    <h3 class="text-lg font-semibold text-maroon mb-2">
        Informasi Petugas
    </h3>
    <p class="text-gray-600 text-sm leading-relaxed">
        Dashboard ini digunakan untuk memantau transaksi pembayaran SPP siswa
        berdasarkan hari, bulan, dan tahun tertentu.
    </p>
</div>

@endsection
