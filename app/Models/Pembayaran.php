<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';

    protected $fillable = [
        'siswa_id',
        'petugas_id',
        'spp_id',
        'tgl_bayar',
        'bulan_dibayar',
        'tahun_dibayar',
        'jumlah_bayar'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'petugas_id');
    }

    public function spp()
    {
        return $this->belongsTo(Spp::class);
    }
}
