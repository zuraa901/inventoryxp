<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $table = 'assets';

    protected $fillable = [
        'kode_asset',
        'nama_asset',
        'status',
        'lokasi',
    ];

    public $timestamps = false;
}