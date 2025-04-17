<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    protected $fillable = [
        'pulau',
        'provinsi',
        'kota_kab',
        'kelurahan_kecamatan',
        'harga_satuan',
        'minimal_kg',
        'estimasi',
        'views'
    ];
} 