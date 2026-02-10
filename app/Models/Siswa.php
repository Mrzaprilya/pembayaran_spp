<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';

    protected $fillable = [
        'nisn', 'nis', 'nama', 'kelas_id', 'alamat',
        'no_telp', 'spp_id', 'user_id'
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
    public function spp()
{
    return $this->belongsTo(Spp::class, 'spp_id'); 
}
public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }
}
