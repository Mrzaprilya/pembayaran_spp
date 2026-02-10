<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spp extends Model
{
    protected $table = 'spp';

    protected $fillable = [
        'tahun', 'kategori', 'nominal', 'tanggal_berlaku', 'is_active'
    ];

    protected $casts = [
        'tanggal_berlaku' => 'date',
        'is_active' => 'boolean',
    ];
}
