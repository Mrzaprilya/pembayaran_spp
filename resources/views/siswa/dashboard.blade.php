@extends('layout.siswa')

@section('content')
<!-- STUDENT INFO CARD -->
<div class="bg-gradient-to-r from-maroon to-maroonLight rounded-xl shadow-lg p-6 mb-6 text-white">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold mb-2">
                Halo, {{ $siswa->nama }}! 👋
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div>
                    <span class="opacity-75">NISN:</span>
                    <span class="ml-2 font-semibold">{{ $siswa->nisn }}</span>
                </div>
                <div>
                    <span class="opacity-75">No. Telepon:</span>
                    <span class="ml-2 font-semibold">{{ $siswa->no_telp }}</span>
                </div>
            </div>
        </div>
        <div class="text-right">
            <div class="bg-white/20 rounded-lg px-4 py-2">
                <p class="text-xs opacity-75">Kategori SPP</p>
                <p class="text-lg font-bold capitalize">{{ $sppKategori }}</p>
            </div>
        </div>
    </div>
</div>

<h2 class="text-2xl font-bold text-maroon mb-6">
    Dashboard Siswa
</h2>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

    <!-- SPP BULAN INI -->
    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="text-sm text-gray-500 mb-1">SPP Bulan Ini</h3>
        <p class="text-xl font-bold text-maroon">
            {{ $bulanIni }} {{ $tahunSekarang }}
        </p>

        @if($pembayaranBulanIni)
            <span class="inline-block mt-3 px-3 py-1 text-sm rounded-full
                         bg-green-100 text-green-700 font-semibold">
                LUNAS
            </span>
        @else
            <span class="inline-block mt-3 px-3 py-1 text-sm rounded-full
                         bg-red-100 text-red-700 font-semibold">
                BELUM BAYAR
            </span>
        @endif
    </div>

    <!-- PEMBAYARAN TERAKHIR -->
    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="text-sm text-gray-500 mb-1">Pembayaran Terakhir</h3>

        @if($lastPayment)
            <p class="text-xl font-bold text-maroon">
                Rp {{ number_format($lastPayment->jumlah_bayar,0,',','.') }}
            </p>
            <p class="text-sm text-gray-500 mt-1">
                {{ $lastPayment->bulan_dibayar }}
                {{ $lastPayment->tahun_dibayar }}
            </p>
            <p class="text-xs text-gray-400 mt-1">
                Dibayar: {{ $lastPayment->tgl_bayar }}
            </p>
        @else
            <p class="text-gray-400">Belum ada pembayaran</p>
        @endif
    </div>

    <!-- TOTAL SUDAH DIBAYAR TAHUN INI -->
    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="text-sm text-gray-500 mb-1">Sudah Dibayar ({{ $tahunSekarang }})</h3>
        <p class="text-2xl font-bold text-green-600">
            Rp {{ number_format($totalBayarTahunIni,0,',','.') }}
        </p>
        <p class="text-sm text-gray-500 mt-1">
            Total pembayaran tahun {{ $tahunSekarang }}
        </p>
    </div>

    <!-- TOTAL BELUM DIBAYAR -->
    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="text-sm text-gray-500 mb-1">Belum Dibayar ({{ $tahunSekarang }})</h3>
        <p class="text-2xl font-bold text-red-600">
            Rp {{ number_format($totalBelumBayar,0,',','.') }}
        </p>
        <p class="text-sm text-gray-500 mt-1">
            {{ $jumlahBulanBelumBayar }} bulan belum dibayar
        </p>
    </div>

</div>

<!-- MONTHLY MONITORING -->
<div class="bg-white rounded-xl shadow-lg p-6 mt-6">
    <h3 class="text-lg font-semibold text-maroon mb-4">
        Monitoring Pembayaran Bulanan {{ $tahunSekarang }}
    </h3>
    
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @foreach($monthlyStatus as $month)
        <div class="border rounded-lg p-3 text-center @if($month['status'] == 'Lunas') border-green-200 bg-green-50 @else border-red-200 bg-red-50 @endif">
            <p class="font-medium text-sm mb-1">{{ $month['bulan'] }}</p>
            @if($month['status'] == 'Lunas')
                <span class="inline-block px-2 py-1 text-xs rounded-full bg-green-500 text-white font-semibold">
                    Lunas
                </span>
            @else
                <span class="inline-block px-2 py-1 text-xs rounded-full bg-red-500 text-white font-semibold">
                    Belum
                </span>
            @endif
        </div>
        @endforeach
    </div>
</div>

<!-- SUMMARY CARDS -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">

    <!-- TOTAL PEMBAYARAN SEMUA WAKTU -->
    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="text-sm text-gray-500 mb-1">Total Pembayaran (Semua Waktu)</h3>
        <p class="text-3xl font-bold text-maroon">
            Rp {{ number_format($totalBayar,0,',','.') }}
        </p>
        <p class="text-sm text-gray-500 mt-1">
            Akumulasi seluruh pembayaran SPP yang sudah dibayarkan
        </p>
    </div>

    <!-- RINGKASAN TAHUN INI -->
    <div class="bg-gradient-to-r from-maroon to-maroonLight p-6 rounded-xl shadow text-white">
        <h3 class="text-sm opacity-90 mb-1">Ringkasan {{ $tahunSekarang }}</h3>
        <div class="grid grid-cols-2 gap-4 mt-4">
            <div>
                <p class="text-2xl font-bold">{{ 12 - $jumlahBulanBelumBayar }}</p>
                <p class="text-xs opacity-75">Bulan Dibayar</p>
            </div>
            <div>
                <p class="text-2xl font-bold">{{ $jumlahBulanBelumBayar }}</p>
                <p class="text-xs opacity-75">Bulan Belum Dibayar</p>
            </div>
        </div>
    </div>

</div>
@endsection
