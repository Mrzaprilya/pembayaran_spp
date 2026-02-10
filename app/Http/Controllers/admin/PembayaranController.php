<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Kelas;

class PembayaranController extends Controller
{
    // =========================
    // HISTORY PEMBAYARAN
    // =========================
    public function index(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $kelas = $request->kelas;

        $query = Pembayaran::with(['siswa.kelas','petugas','spp']);

        if ($bulan) {
            $query->where('bulan_dibayar', $bulan);
        }

        if ($tahun) {
            $query->where('tahun_dibayar', $tahun);
        }

        if ($kelas) {
            $query->whereHas('siswa.kelas', function($q) use ($kelas) {
                $q->where('nama_kelas', $kelas);
            });
        }

        $data = $query->orderBy('tgl_bayar','desc')->get();

        // Get list of classes for filter dropdown
        $listKelas = Kelas::orderBy('nama_kelas')->pluck('nama_kelas');

        return view('admin.pembayaran.index', compact('data','bulan','tahun','kelas','listKelas'));
    }

    // =========================
    // EXPORT EXCEL
    // =========================
    public function exportExcel(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $kelas = $request->kelas;

        $query = Pembayaran::with(['siswa.kelas','petugas','spp']);

        if ($bulan) {
            $query->where('bulan_dibayar', $bulan);
        }

        if ($tahun) {
            $query->where('tahun_dibayar', $tahun);
        }

        if ($kelas) {
            $query->whereHas('siswa.kelas', function($q) use ($kelas) {
                $q->where('nama_kelas', $kelas);
            });
        }

        $data = $query->get();

        // HEADER EXCEL
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=laporan_pembayaran.xls");

        echo "No\tSiswa\tKelas\tBulan\tTahun\tNominal\tPetugas\n";

        $no = 1;
        foreach ($data as $p) {
            echo $no++ . "\t";
            echo $p->siswa->nama . "\t";
            echo $p->siswa->kelas->nama_kelas . "\t";
            echo $p->bulan_dibayar . "\t";
            echo $p->tahun_dibayar . "\t";
            echo $p->spp->nominal . "\t";
            echo ($p->petugas->nama ?? '-') . "\n";
        }

        exit;
    }
}
