<?php

namespace App\Exports;

use App\Models\Pembayaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PembayaranExport implements FromCollection, WithHeadings
{
    protected $bulan;
    protected $tahun;

    public function __construct($bulan, $tahun)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    public function collection()
    {
        $query = Pembayaran::with(['siswa.kelas','petugas','spp']);

        if ($this->bulan) {
            $query->where('bulan_dibayar', $this->bulan);
        }

        if ($this->tahun) {
            $query->where('tahun_dibayar', $this->tahun);
        }

        return $query->get()->map(function ($item) {
            return [
                'Nama Siswa' => $item->siswa->nama ?? '-',
                'Kelas' => $item->siswa->kelas->nama_kelas ?? '-',
                'Bulan' => $item->bulan_dibayar,
                'Tahun' => $item->tahun_dibayar,
                'Jumlah' => $item->spp->nominal ?? 0,
                'Petugas' => $item->petugas->nama ?? '-',
                'Tanggal Bayar' => $item->tgl_bayar
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama Siswa',
            'Kelas',
            'Bulan',
            'Tahun',
            'Jumlah',
            'Petugas',
            'Tanggal Bayar'
        ];
    }
}
