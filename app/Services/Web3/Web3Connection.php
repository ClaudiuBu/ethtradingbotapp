<?php

namespace App\Services\Web3;

use Web3\Web3;
use Web3\Contract;
use App\Models\Configurations;
use Web3\Providers\HttpProvider;
use Web3\RequestManagers\HttpRequestManager;

class Web3Connection
{
    public $web3;
    public $pairContract;
    public $factoryContract;
    public $tokenContract;
    public $uniswap_pair_address_v2 = '0xC75650fe4D14017b1e12341A97721D5ec51D5340';
    public $uniswap_factory_address_v2 = '0x5C69bEe701ef814a2B6a3EDD4B1652CB9cc5aA6f';

    public function __construct()
    {
        if (Configurations::getValue('http_provider_endpoint', true)) {
            $this->web3 = new Web3(new HttpProvider(new HttpRequestManager(Configurations::getValue('http_provider_endpoint'))));
            $this->pairContract = new Contract(Configurations::getValue('http_provider_endpoint'), file_get_contents('abi/uniswapPairV2.json', true));
            $this->factoryContract = new Contract(Configurations::getValue('http_provider_endpoint'), file_get_contents('abi/uniswapFactoryV2.json', true));
            $this->tokenContract = new Contract(Configurations::getValue('http_provider_endpoint'), file_get_contents('abi/erc20.json', true));
        }
    }
}
