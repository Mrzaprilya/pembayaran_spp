<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Petugas;
use App\Models\Kelas;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $bulan = request('bulan'); // Ambil bulan dari dropdown
        $tahun = request('tahun', now()->year); // Ambil tahun dari dropdown, default tahun ini
        $bulanIni = now()->month;
        $tahunIni = now()->year;

        // CARD ATAS
        $totalSiswa = Siswa::count();
        $totalPetugas = Petugas::count();
        $totalKelas = Kelas::count();
        
        // Total pemasukan untuk bulan dan tahun yang dipilih
        if ($bulan) {
            $pemasukanBulanIni = Pembayaran::where('bulan_dibayar', $bulan)
                ->whereYear('tgl_bayar', $tahun)
                ->sum('jumlah_bayar');
        } else {
            // Jika tidak ada bulan yang dipilih, tampilkan total tahun ini
            $pemasukanBulanIni = Pembayaran::whereYear('tgl_bayar', $tahun)
                ->sum('jumlah_bayar');
        }

        // STATISTIK PEMASUKAN
        $query = Pembayaran::whereYear('tgl_bayar', $tahun);

        if ($bulan) {
            // Filter berdasarkan nama bulan
            $query->where('bulan_dibayar', $bulan);
        }

        $statistik = $query->selectRaw('bulan_dibayar as bulan, SUM(jumlah_bayar) as total')
            ->groupBy('bulan_dibayar')
            ->orderByRaw('FIELD(bulan_dibayar, "Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember")')
            ->get();

        // Get available years for dropdown
        $availableYears = Pembayaran::selectRaw('YEAR(tgl_bayar) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        // PEMBAYARAN TERBARU
        $pembayaranTerbaru = Pembayaran::with('siswa')
            ->latest('tgl_bayar')
            ->take(5)
            ->get();

        return view('admin.index', compact(
            'totalSiswa',
            'totalPetugas',
            'totalKelas',
            'pemasukanBulanIni',
            'statistik',
            'pembayaranTerbaru',
            'bulan',
            'tahun',
            'availableYears'
        ));
    }
}
