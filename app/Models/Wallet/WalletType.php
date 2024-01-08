<?php


use Illuminate\Database\Eloquent\Model;

class WalletType extends Model
{
    protected $guarded = ['id_wallet_type'];

    public static function createWalletType(array $walletType): WalletType
    {
        $walletType = WalletType::create([
            'wallet_type' => $walletType['wallet_type'],
        ]);
        return $walletType;
    }
}
