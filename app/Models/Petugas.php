<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    protected $table = 'petugas';

    protected $fillable = [
    'user_id',
    'nama',
    'no_telp',
    'username',
    'password',
    'level'
];

    public function pembayaran()
   
{
    return $this->hasMany(Pembayaran::class, 'petugas_id');
}

    
}
