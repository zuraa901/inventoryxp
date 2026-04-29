<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = 'inventory';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'jenis_barang',
        'stok',
    ];

    public $timestamps = false;
}