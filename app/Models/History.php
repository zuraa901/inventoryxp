<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'history';

    protected $fillable = [
        'user_name',
        'activity',
        'target_type',
        'target_name',
        'description',
    ];

    public $timestamps = false;
}
