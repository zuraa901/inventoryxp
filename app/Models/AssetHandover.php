<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetHandover extends Model
{
    protected $table = 'asset_handover';

    protected $fillable = [
        'asset_id',
        'penerima',
        'lokasi',
        'tanggal',
    ];

    public $timestamps = false;
}