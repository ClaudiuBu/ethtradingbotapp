<?php

namespace App\Services\Web3\Contracts;

class Contract
{
    public $web3;
    public $contract;
    public $public_address;

    public function __construct($web3, $abi, $public_address = null)
    {
        $this->web3 = $web3;
        $this->contract = new \Web3\Contract($web3->provider, $abi);
        $this->public_address = $public_address;
    }

    public function getPublicAddress()
    {
        return $this->public_address;
    }

    public function getContract()
    {
        return $this->contract;
    }

    public function getWeb3()
    {
        return $this->web3;
    }
}
