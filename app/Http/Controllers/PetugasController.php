<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Siswa;

class PetugasController extends Controller
{
    public function index(Request $request)
    {
        // Mapping nama bulan Indonesia
        $bulanList = [
            'Januari','Februari','Maret','April','Mei','Juni',
            'Juli','Agustus','September','Oktober','November','Desember'
        ];

        // Default bulan & tahun (jika tidak dipilih)
        $bulan = $request->bulan ?? $bulanList[date('n') - 1];
        $tahun = $request->tahun ?? date('Y');

        // Get current month for income calculation
        $bulanSekarang = $bulanList[date('n') - 1];
        $tahunSekarang = date('Y');

        return view('petugas.index', [
            // Pembayaran hari ini
            'hariIni' => Pembayaran::whereDate('tgl_bayar', now())->count(),

            // Total siswa
            'totalSiswa' => Siswa::count(),

            // Transaksi bulan tertentu
            'transaksiBulan' => Pembayaran::where('bulan_dibayar', $bulan)
                ->where('tahun_dibayar', $tahun)
                ->count(),

            // Total pembayaran bulan yang dipilih
            'totalPembayaranBulan' => Pembayaran::where('bulan_dibayar', $bulan)
                ->where('tahun_dibayar', $tahun)
                ->sum('jumlah_bayar'),

            // Total pendapatan bulan ini
            'pendapatanBulanIni' => Pembayaran::where('bulan_dibayar', $bulanSekarang)
                ->where('tahun_dibayar', $tahunSekarang)
                ->sum('jumlah_bayar'),

            // Untuk dikirim ke view
            'bulan' => $bulan,
            'tahun' => $tahun,
            'bulanList' => $bulanList
        ]);
    }
}
