<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pair extends Model
{
    //protected id
    protected $fillable = [
        'pair_address',
        'token0_address',
        'token1_address',
        'blacklisted',
        'block_timestamp',
        'block_number'
    ];
}
