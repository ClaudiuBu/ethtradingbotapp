<?php

use App\Services\Web3\Contracts\Contract;

class FactoryContract extends Contract
{
    public function __construct($web3, $abi, $public_address = null)
    {
        parent::__construct($web3, $abi, $public_address);
    }

    public function getPair($tokenA, $tokenB)
    {
        $this->contract->at($this->public_address)->call('getPair', [$tokenA, $tokenB], function ($err, $result) {
            if ($err !== null) {
                echo 'Error: ' . $err->getMessage();
                return;
            }
            return $result;
        });
    }

    public function allPairs($index)
    {
        $this->contract->at($this->public_address)->call('allPairs', [$index], function ($err, $result) {
            if ($err !== null) {
                echo 'Error: ' . $err->getMessage();
                return;
            }
            return $result;
        });
    }

    public function allPairsLength()
    {
        $pairsNumber = 0;
        $this->contract->at($this->public_address)->call('allPairsLength', '', function ($err, $event) use (&$pairsNumber) {
            if ($err !== null) {
            } else {
                $pairsNumber = (int)$event[0]->toString();
            }
        });
        return $pairsNumber;
    }

    public function feeTo()
    {
        $this->contract->at($this->public_address)->call('feeTo', [], function ($err, $result) {
            if ($err !== null) {
                echo 'Error: ' . $err->getMessage();
                return;
            }
            return $result;
        });
    }

    public function feeToSetter()
    {
        $this->contract->at($this->public_address)->call('feeToSetter', [], function ($err, $result) {
            if ($err !== null) {
                echo 'Error: ' . $err->getMessage();
                return;
            }
            return $result;
        });
    }
}
