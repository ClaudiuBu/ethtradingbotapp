<?php

namespace App\Services\Web3;

//it starts trading only when liquidity is added to the pool/bookmerked link to the function/mint function is called (i think)


use App\Models\Pair as PairModel;
use Illuminate\Console\Concerns\InteractsWithIO;
use Symfony\Component\Console\Output\ConsoleOutput;

class Eth
{
    use InteractsWithIO;

    public $web3Connection;
    public $pairContract;
    public $factoryContract;
    public $uniswapV2PairAddress;
    public $uniswapV2FactoryAddress;
    public $tokenContract;


    public function __construct()
    {
        $this->output = new ConsoleOutput();

        $this->web3Connection = app('web3_connection')->web3;
        $this->pairContract = app('web3_connection')->pairContract;
        $this->factoryContract = app('web3_connection')->factoryContract;
        $this->tokenContract = app('web3_connection')->tokenContract;
        $this->uniswapV2PairAddress = app('web3_connection')->uniswap_pair_address_v2;
        $this->uniswapV2FactoryAddress = app('web3_connection')->uniswap_factory_address_v2;
    }

    /*
    * Get latest block number from blockchain
    */
    public function getLatestBlock(): int
    {
        $blockNumber = 0;
        $this->web3Connection->eth->blockNumber(function ($err, $data) use (&$blockNumber) {
            if ($err !== null) {
                $blockNumber = 0;
            } else {
                $blockNumber = (int)$data->toString();
            }
        });
        return $blockNumber;
    }
    /*
    *   Get latest block timestamp from blockchain
    */

    public function getLatestBlockTimestamp()
    {
        $blockTimestamp = 0;
        $this->web3Connection->eth->getBlockByNumber($this->getLatestBlock(), false, function ($err, $data) use (&$blockTimestamp) {
            if ($err !== null) {
                $blockTimestamp = 0;
            } else {
                $blockTimestamp = (int)$data->timestamp;
            }
        });
        return $blockTimestamp;
    }

    /*
    *   Gets total number of pairs on Uniswap(v2)
    */

    public function getAllPairsLength()
    {
        $pairsNumber = 0;
        $this->factoryContract->at($this->uniswapV2FactoryAddress)->call('allPairsLength', '', function ($err, $event) use (&$pairsNumber) {
            if ($err !== null) {
            } else {
                $pairsNumber = (int)$event[0]->toString();
            }
        });
        return $pairsNumber;
    }

    public function getWalletInfo(string $public_address, string $type)
    {
        $this->getWalletFirstActivity($public_address);
        die;
        return [
            'wallet_address' => $public_address,
            'balances' => $this->getWalletBalances($public_address),
            'source_of_funds'=> $this->getWalletSourceOfFunds($public_address),
            'interacted_with'=> $this->getWalletInteractedWith($public_address),
            'first_activity' => $this->getWalletFirstActivity($public_address),
            'number_of_txs' => $this->getWalletNumberOfTXs($public_address), //TODO: Think/Test // Number of transactions from this address
            'wallet_type' => $type,
        ];
    }

    /**
     * TODO: Think/Test // Number of transactions from this address
     */
    public function getWalletNumberOfTXs(string $public_address)
    {
        $firstActivity = 0;
        $this->web3Connection->eth->getTransactionCount($public_address, function ($err, $data) use (&$firstActivity) {
            if ($err !== null) {
                $firstActivity = 0;
            } else {
                $firstActivity = (int)$data->toString();
            }
        });
        return $firstActivity;
    }


    /**
     * TODO: Think/Test // Number of transactions from this address
     */
    public function getWalletFirstActivity(string $public_address)
    {
        $firstTx = 0;
        $this->web3Connection->eth->getFirstTransaction($public_address, function ($err, $data) use (&$firstTx) {
            if ($err !== null) {
                $firstTx = 0;
            } else {
                $firstTx = (int)$data->toString();
                dump($firstTx);
                die;
            }
        });
    }

    /**
     * TODO: Think
     */
    public function getWalletSourceOfFunds(string $public_address)
    {
        $sourceOfFunds = [];
        return $sourceOfFunds = null;
    }

    /**
     * TODO: Think
     */
    public function getWalletInteractedWith(string $public_address)
    {
        $interactedWith = [];
        return $interactedWith = null;
    }

    /**
     * TODO: Think/Test
     */
    public function getWalletBalances(string $public_address)
    {
        $balances = [];
        $this->web3Connection->eth->getBalance($public_address, function ($err, $data) use (&$balances) {
            if ($err !== null) {
                $balances = [];
            } else {
                $balances['ETH'] = (int)$data->toString()/1000000000000000000;
            }
        });
        return (string)$balances['ETH'];
    }

    public function getTokenInfo(string $tokenAddress)
    {
        [$tokenOwner, $txHash] = $this->getTokenOwnerAndTxHash($tokenAddress);
        $contractSourceCode = $this->getContractVerified($tokenAddress)->result[0]->SourceCode;
        $contractSourceCode = $contractSourceCode != '' ? $contractSourceCode : 'Contract source code not verified';
        return [
            'token_address' => $tokenAddress,
            'token_symbol' => $this->getTokenSymbol($tokenAddress),
            'token_name' => $this->getTokenName($tokenAddress),
            'token_decimals' => $this->getTokenDecimals($tokenAddress),
            'token_total_supply'=>$this->getTokenTotalSupply($tokenAddress),
            'token_owner' => $tokenOwner,
            'tx_hash' => $txHash,
            'contract_verified'=> $contractSourceCode != 'Contract source code not verified' ? true : false,
            'contract_source_code' => $contractSourceCode != 'Contract source code not verified' ? json_encode($contractSourceCode) : null,
            'token_block_timestamp' => $this->getTokenBlockTimestamp($tokenAddress),
            'token_block_number' => $this->getTokenBlockNumber($tokenAddress),
        ];
    }
    public function getContractVerified(string $tokenAddress)
    {
        //remove empty spaces from url

        $url = "https://api.etherscan.io/api?module=contract&action=getsourcecode&address=$tokenAddress&apikey=WX9EU8SF7GSVVVKFIMG64X3Z3KZI9BY8V6";

        $client = new \GuzzleHttp\Client();

        $try = true;
        while ($try) {
            try {
                $response = $client->request('GET', $url);
                if ($response->getStatusCode() == 200) {
                    $try = false;
                    return json_decode($response->getBody()->getContents());
                }
                sleep(1);
            } catch (\Exception $e) {
                $this->info(date('Y-m-d H:i:s').' - Error: '.$e->getMessage());
                $try = true;
            }
        }

    }

    //TODO
    public function getTokenBlockNumber(string $tokenAddress)
    {
        $tokenBlockNumber = null;
        return 0;
    }

    //for new not working - TODO
    public function getTokenBlockTimestamp(string $tokenAddress)
    {
        $tokenBlockTimestamp = null;
        return 0;
    }

    public function getTokenOwnerAndTxHash(string $tokenAddress)
    {
        $url = "https://api.etherscan.io/api?module=contract&action=getcontractcreation&contractaddresses=$tokenAddress&apikey=WX9EU8SF7GSVVVKFIMG64X3Z3KZI9BY8V6";
        $client = new \GuzzleHttp\Client();

        $try = true;
        while ($try) {
            try {
                $response = $client->request('GET', $url);
                if ($response->getStatusCode() == 200) {
                    $try = false;
                    $response = json_decode($response->getBody()->getContents());
                    return [$response->result[0]->contractCreator, $response->result[0]->txHash];
                }
                sleep(1);
            } catch (\Exception $e) {
                $this->info(date('Y-m-d H:i:s').' - Error: '.$e->getMessage());
                $try = true;
            }
        }
    }

    public function getTokenTotalSupply(string $tokenAddress)
    {
        $tokenTotalSupply = null;
        $this->pairContract->at($tokenAddress)->call('totalSupply', '', function ($err, $event) use (&$tokenTotalSupply) {
            if ($err !== null) {
            } else {
                $tokenTotalSupply = $event[0];
            }
        });
        return $tokenTotalSupply;
    }

    public function getTokenSymbol(string $tokenAddress)
    {
        $tokenSymbol = null;
        $this->pairContract->at($tokenAddress)->call('symbol', '', function ($err, $event) use (&$tokenSymbol) {
            if ($err !== null) {
            } else {
                $tokenSymbol = $event[0];
            }
        });
        return $tokenSymbol;
    }

    public function getTokenName(string $tokenAddress)
    {
        $tokenName = null;
        $this->pairContract->at($tokenAddress)->call('name', '', function ($err, $event) use (&$tokenName) {
            if ($err !== null) {
            } else {
                $tokenName = $event[0];
            }
        });
        return $tokenName;
    }

    public function getTokenDecimals(string $tokenAddress)
    {
        $tokenDecimals = null;
        $this->pairContract->at($tokenAddress)->call('decimals', '', function ($err, $event) use (&$tokenDecimals) {
            if ($err !== null) {
            } else {
                $tokenDecimals = (int)$event[0]->toString();
            }
        });
        return $tokenDecimals;
    }

    public function getPairInfo(string $pair)
    {
        [$token0Address , $token1Address] = $this->getTokenAddressesFromPair($pair);
        $paiCurrentModel = PairModel::firstOrCreate([
            'pair_address' => $pair,
            'token0_address' => $token0Address,
            'token1_address' => $token1Address,
            'block_number' => $this->getLatestBlock(),
            'block_timestamp' => $this->getLatestBlockTimestamp()
        ]);
        // if($paiCurrentModel->wasRecentlyCreated){} //commented for now - see if i need this property

        return $paiCurrentModel;
    }

    public function getTokenAddressesFromPair(string $pair)
    {
        $token0Address = null;
        $token1Address = null;
        $this->pairContract->at($pair)->call('token0', '', function ($err, $event) use (&$token0Address) {
            if ($err !== null) {
            } else {
                $token0Address = $event[0];
            }
        });

        $this->pairContract->at($pair)->call('token1', '', function ($err, $event) use (&$token1Address) {
            if ($err !== null) {
            } else {
                $token1Address = $event[0];
            }
        });
        if ($token1Address == '0xc02aaa39b223fe8d0a0e5c4f27ead9083c756cc2') {
            $token1Address = $token0Address;
            $token0Address = '0xc02aaa39b223fe8d0a0e5c4f27ead9083c756cc2';
        }
        return [$token0Address, $token1Address];
    }
}
