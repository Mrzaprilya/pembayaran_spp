@extends('admin.layout')

@section('title','Dashboard')

@section('content')

<!-- HEADER -->
<div class="mb-8">
    <h2 class="text-2xl font-bold tracking-wide">Dashboard Admin</h2>
    <p class="text-grayText text-sm mt-1">
        Ringkasan data sistem pembayaran SPP
    </p>
</div>

<!-- STAT CARDS -->
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">

    <!-- SISWA -->
    <div class="bg-darkCard/80 backdrop-blur rounded-xl p-6 shadow-neon border border-white/10">
        <p class="text-grayText text-sm">Total Siswa</p>
        <h3 class="text-3xl font-bold text-neonGreen mt-2">
            1.200
        </h3>
        <p class="text-xs text-grayText mt-2">Data siswa terdaftar</p>
    </div>

    <!-- PETUGAS -->
    <div class="bg-darkCard/80 backdrop-blur rounded-xl p-6 shadow-neon border border-white/10">
        <p class="text-grayText text-sm">Total Petugas</p>
        <h3 class="text-3xl font-bold text-neonGreen mt-2">
            25
        </h3>
        <p class="text-xs text-grayText mt-2">Petugas aktif</p>
    </div>

    <!-- KELAS -->
    <div class="bg-darkCard/80 backdrop-blur rounded-xl p-6 shadow-neon border border-white/10">
        <p class="text-grayText text-sm">Total Kelas</p>
        <h3 class="text-3xl font-bold text-neonGreen mt-2">
            18
        </h3>
        <p class="text-xs text-grayText mt-2">Kelas tersedia</p>
    </div>

    <!-- PEMBAYARAN -->
    <div class="bg-darkCard/80 backdrop-blur rounded-xl p-6 shadow-neon border border-white/10">
        <p class="text-grayText text-sm">Total Pembayaran</p>
        <h3 class="text-3xl font-bold text-neonGreen mt-2">
            Rp 1,2 M
        </h3>
        <p class="text-xs text-grayText mt-2">Akumulasi pembayaran</p>
    </div>

</div>

<!-- INFO BOX -->
<div class="mt-10 bg-darkCard/70 border border-white/10 rounded-xl p-6">
    <h4 class="text-lg font-semibold mb-2">Informasi Sistem</h4>
    <p class="text-sm text-grayText leading-relaxed">
        Dashboard ini digunakan untuk memantau data siswa, petugas, kelas,
        serta transaksi pembayaran SPP secara real-time.
        Pastikan data selalu diperbarui agar laporan tetap akurat.
    </p>
</div>

@endsection
