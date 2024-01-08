<?php

namespace App\Models\Wallet;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $guarded = ['id'];


    public static function createWallet(array $walletArr): Wallet
    {
        $wallet =  Wallet::firstOrCreate([
            'wallet_address' => $walletArr['wallet_address'],
            'balances' => $walletArr['balances'],
            'interacted_with' => $walletArr['interacted_with'],
            'first_activity' => $walletArr['first_activity'],
            'source_of_funds' => $walletArr['source_of_funds'],
            'number_of_txs' => $walletArr['number_of_txs'],
        ]);

        return $wallet;
    }
}
