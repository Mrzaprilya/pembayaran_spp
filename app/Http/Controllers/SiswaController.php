<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\Spp;

class SiswaController extends Controller
{
    public function dashboard()
{
    $siswaId = session('siswa_id');

    $bulanSekarang = date('F');
    $tahunSekarang = date('Y');

    $bulanMap = [
        'January' => 'Januari',
        'February' => 'Februari',
        'March' => 'Maret',
        'April' => 'April',
        'May' => 'Mei',
        'June' => 'Juni',
        'July' => 'Juli',
        'August' => 'Agustus',
        'September' => 'September',
        'October' => 'Oktober',
        'November' => 'November',
        'December' => 'Desember',
    ];

    $bulanIni = $bulanMap[$bulanSekarang];

    // Get student info to determine SPP amount
    $siswa = Siswa::with(['spp', 'kelas'])->find($siswaId);
    $sppAmount = $siswa->spp->nominal ?? 0;
    $sppKategori = $siswa->spp->kategori ?? 'normal';

    // Pembayaran terakhir
    $lastPayment = Pembayaran::where('siswa_id', $siswaId)
        ->orderBy('tgl_bayar', 'desc')
        ->first();

    // Pembayaran bulan ini (current month, current year)
    $pembayaranBulanIni = Pembayaran::where('siswa_id', $siswaId)
        ->where('bulan_dibayar', $bulanIni)
        ->where('tahun_dibayar', $tahunSekarang)
        ->first();

    // Total pembayaran (all time)
    $totalBayar = Pembayaran::where('siswa_id', $siswaId)
        ->sum('jumlah_bayar');

    // Total pembayaran tahun ini
    $totalBayarTahunIni = Pembayaran::where('siswa_id', $siswaId)
        ->where('tahun_dibayar', $tahunSekarang)
        ->sum('jumlah_bayar');

    // Bulan-bulan yang sudah dibayar tahun ini
    $bulanDibayar = Pembayaran::where('siswa_id', $siswaId)
        ->where('tahun_dibayar', $tahunSekarang)
        ->pluck('bulan_dibayar')
        ->toArray();

    // Create monthly status array
    $monthlyStatus = [];
    foreach ($bulanMap as $english => $indonesian) {
        $monthlyStatus[] = [
            'bulan' => $indonesian,
            'status' => in_array($indonesian, $bulanDibayar) ? 'Lunas' : 'Belum'
        ];
    }

    // Total bulan dalam setahun
    $totalBulanSetahun = 12;

    // Jumlah bulan yang belum dibayar
    $jumlahBulanBelumBayar = $totalBulanSetahun - count($bulanDibayar);

    // Total uang yang belum dibayar
    $totalBelumBayar = $jumlahBulanBelumBayar * $sppAmount;

    return view('siswa.dashboard', compact(
        'lastPayment',
        'pembayaranBulanIni',
        'bulanIni',
        'tahunSekarang',
        'totalBayar',
        'totalBayarTahunIni',
        'jumlahBulanBelumBayar',
        'totalBelumBayar',
        'siswa',
        'sppKategori',
        'monthlyStatus'
    ));
}


    public function history(Request $request)
    {
        $siswaId = session('siswa_id');
        $tahun   = $request->tahun ?? date('Y');

        // Get all payments for the selected year
        $pembayaran = Pembayaran::where('siswa_id', $siswaId)
            ->where('tahun_dibayar', $tahun)
            ->get();

        // Create array of all months with payment status
        $bulanMap = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        $monthlyHistory = [];
        foreach ($bulanMap as $bulan) {
            $payment = $pembayaran->where('bulan_dibayar', $bulan)->first();
            
            $monthlyHistory[] = [
                'bulan' => $bulan,
                'tanggal_bayar' => $payment ? $payment->tgl_bayar : null,
                'jumlah_bayar' => $payment ? $payment->jumlah_bayar : null,
                'status' => $payment ? 'LUNAS' : 'BELUM'
            ];
        }

        $listTahun = Pembayaran::where('siswa_id', $siswaId)
            ->select('tahun_dibayar')
            ->distinct()
            ->orderBy('tahun_dibayar', 'desc')
            ->pluck('tahun_dibayar');

        return view('siswa.history', compact('monthlyHistory', 'listTahun', 'tahun'));
    }
}
