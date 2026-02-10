@extends('layout.siswa')

@section('content')
<h2 class="text-3xl font-bold text-maroon mb-6">History Pembayaran</h2>

<form method="GET" class="mb-4">
    <select name="tahun"
        onchange="this.form.submit()"
        class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-gold focus:border-gold outline-none">
        @foreach($listTahun as $th)
            <option value="{{ $th }}" {{ $tahun == $th ? 'selected' : '' }}>
                Tahun {{ $th }}
            </option>
        @endforeach
    </select>
</form>

<div class="bg-white rounded shadow overflow-x-auto">
<table class="w-full text-sm">
    <thead class="bg-maroon text-gold">
        <tr>
            <th class="p-3 text-left">Bulan</th>
            <th class="p-3 text-left">Tanggal Bayar</th>
            <th class="p-3 text-left">Jumlah</th>
            <th class="p-3 text-left">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($monthlyHistory as $month)
        <tr class="border-b @if($month['status'] == 'BELUM') bg-gray-50 @endif">
            <td class="p-3 font-medium">{{ $month['bulan'] }}</td>
            <td class="p-3">
                @if($month['tanggal_bayar'])
                    {{ $month['tanggal_bayar'] }}
                @else
                    <span class="text-gray-400">-</span>
                @endif
            </td>
            <td class="p-3">
                @if($month['jumlah_bayar'])
                    Rp {{ number_format($month['jumlah_bayar'],0,',','.') }}
                @else
                    <span class="text-gray-400">-</span>
                @endif
            </td>
            <td class="p-3">
                @if($month['status'] == 'LUNAS')
                    <span class="inline-block px-3 py-1 text-xs rounded-full bg-green-100 text-green-700 font-semibold">
                        LUNAS
                    </span>
                @else
                    <span class="inline-block px-3 py-1 text-xs rounded-full bg-red-100 text-red-700 font-semibold">
                        BELUM
                    </span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

<!-- SUMMARY -->
<div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
        <h3 class="text-green-800 font-semibold mb-2">Sudah Dibayar</h3>
        <p class="text-2xl font-bold text-green-600">
            {{ collect($monthlyHistory)->where('status', 'LUNAS')->count() }} Bulan
        </p>
        <p class="text-sm text-green-700 mt-1">
            Total: Rp {{ number_format(collect($monthlyHistory)->where('status', 'LUNAS')->sum('jumlah_bayar'),0,',','.') }}
        </p>
    </div>
    
    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
        <h3 class="text-red-800 font-semibold mb-2">Belum Dibayar</h3>
        <p class="text-2xl font-bold text-red-600">
            {{ collect($monthlyHistory)->where('status', 'BELUM')->count() }} Bulan
        </p>
        <p class="text-sm text-red-700 mt-1">
            Menunggu pembayaran
        </p>
    </div>
</div>
@endsection
