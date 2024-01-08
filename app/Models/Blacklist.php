<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blacklist extends Model
{
    protected $guarded = ['id'];

    public static function blacklistToken(array $token, string $reason): Blacklist
    {
        $blacklist = Blacklist::create([
            'token_owner' => $token['owner'],
            'token_name' => $token['name'],
            'token_address' => $token['address'],
            'token_symbol' => $token['symbol'],
            'reaason'=> $reason,
        ]);
        return $blacklist;
    }
}
