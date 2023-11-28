<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class midtrans extends Model
{
    use HasFactory;

    protected $fillable = [
        'trx_id',
        'user_id',
        'user_zone',
        'packet_name',
        'total_price',
        'status',
        'snap_token',
    ];
}
