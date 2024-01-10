<?php

/*
* TO DO
* 1. Create a function/implement Telegram bot to send notification to the user when a new token is created
* 2. Create WhiteListedTokens that are safe to snipe
* //create a function to check if honeypot/rug
 3. Create BlackListedTokens that are not safe to snipe/get abi to check contracts prior and identify scam patterns
* 3.1 Make a blacklist word list to automatically ban tokens with scam words in their name
* 4. Create the following services: TokenListenerService - get latest pairs , TokenMonitoringService - checks and adds  additional info for tokens(like if
contract is verified and other things), TokenTradingService(Serviciul care se ocupa de snipping si de monitorizarea trade-urilor active)
Posibil ca trebuie si un serviciu care sa se ocupe de verificarea contractelor si de adaugarea de informatii suplimentare despre tokeni
sau sa creez un serviciu care ia preturile in real time pentru a calcula profitul
De creat sistem de notificari pentru telegram si pentru email cand se creeaza un nou token si cand se tradeaza un token nou(inchide trade/profit yada yada)
De asemenea pot implementa gpt-4 pentru a folosit botul in scopul de validare(to look into it/ML ideas around it)
/Validarea contractelor de vazut ce le face scam/rug/honeypot - sisteme complexe de validare(check ABI/sau bytecode DE VAZUT)
Intentia de scam este data de contract_owner - de intuit intentia lui, legit project or not(de cat timp e creat walletul,ce balance  are,ce istoric de trading
daca balance-ul e venit de pe exchange sau de la un alt wallet care e trusty - de jucat cu ideea asta)

//also pair-ul de uniswap e creat in momentul cand e tradable? sau cand se adauga lichidatatea?
//if so, trebuie monitorizat eventul cand se adauga lichidaitatea pe pair-ul respectiv/atunci se poate trade-ui

//Statistica pe trade-uri/tabela statistics pentru info(metrics)
//creare configurare pentru watertrade or real trade - in sensul ca nu e pe real money)
*/

//might use telegram bot to buy/sell not to make this app to complex/use php
// dextools are api -

//analitics cu graph/noduri/topologia monedei, cu enfaza pe adresa care creeaza moneda/noduri/topologie/relatii intre walleturi/ pentru sursa fondurilor a walletului - de unde vin fondurile,de pe ce exchange,de la ce wallet,de la ce contract,de la ce wallet//ca si la networking graph
//flower of life - inspirat de teerrance howard / topologie de retea

//statistica cu raportul de noi holders, ratia, si in functie de asta sa ies sau sa intru

//scapper pentru a lua date de pe 4chan/biz si face sentiment analysis pe ce se discuta acolo/ce monede sunt mentionate and so on/analytics
/**
 * TokenListenerService
 */


//service called API rotator - to rotate api keys

//service called WalletRotator - to rotate wallets in order to avoid being shadowed/followed by bots


//  replay mode - simulate a token launch from t0 to tn and test stategies (for entry/exit) - gen daca o sa fac un bot sa am o diagrama
//cu care sa pozitionez strategiile de entry cu drag and drop
//care pot gen sa adaug strategii pentru entry si exit si sa le testez pe replay mode - sa vad cum ar fi mers

//daca merge automat sa implementez failsafes/breaks

//think of everything as of a car

namespace App\Services;

use App\Services\Web3\Eth;
use App\Services\Web3\Web3Connection;
use Illuminate\Console\Concerns\InteractsWithIO;
use Symfony\Component\Console\Output\ConsoleOutput;
use App\Models\Token as TokenModel;
use App\Models\Wallet\Wallet as WalletModel;
use App\Models\Blacklist as BlacklistModel;
use App\Models\Pair as PairModel;
use App\Services\Validation\TokenValidation;

class TokenListenerService
{
    use InteractsWithIO;


    public $time;
    public $eth;

    public function __construct()
    {
        $this->output = new ConsoleOutput();
        $this->eth = new Eth();
    }

    public function getDateAndTime()
    {
        $date = date('Y-m-d H:i:s');
        return $date;
    }

    /*
    * Gets pair address by index recursively starting from last index minus n which is specificied in the function, basically n is
    * the number of pairs to take from the end of the list
    */
    public function getLatestPairs(int $n = 5)
    {
        $latestBlock = $this->eth->getLatestBlock();
        $this->info($this->getDateAndTime().' - Latest block: '.$latestBlock);
        $this->info($this->getDateAndTime().' - Getting latest tokens...');

        $pairs = [];

        $currentPair = null; // current pair address
        $pairsLength = $this->eth->getAllPairsLength();
        for ($i = $pairsLength - $n ; $i <= $pairsLength; $i++) {
            $this->eth->factoryContract->at($this->eth->uniswapV2FactoryAddress)->call('allPairs', $i, function ($err, $event) use (&$pairs, &$currentPair) {
                if ($err !== null) {
                } else {
                    $currentPair = $event[0];
                    if (!PairModel::where('pair_address', $currentPair)->exists()) {  //check if pair is not in the db first
                        $pairs[] = $pairModel = $this->eth->getPairInfo($currentPair);
                        $this->info(date('Y-m-d H:i:s').' - Latest pair: '.$currentPair);
                        $pairModel->save();

                        //send info to terminal
                        // $this->info(date('Y-m-d H:i:s').' - Latest tokens: ');
                        $this->info(date('Y-m-d H:i:s').' - Waiting for new tokens...');

                        //first get tokens info
                        $token1  = $this->eth->getTokenInfo($pairModel->token1_address);
                        //validate tokens/blacklist
                        if (TokenValidation::validateToken($token1)) {
                            $tokenModel = TokenModel::firstOrCreate($token1);
                            $this->info(date('Y-m-d H:i:s').' - latest token...'.$tokenModel->token_name.' - '.$tokenModel->token_symbol.' ethscan:https://etherscan.io/address/'.$tokenModel->token_address);
                            $tokenModel->save();

                            WalletModel::createWallet($this->eth->getWalletInfo($tokenModel->token_owner, 'token_owner'));
                        } else {
                            //add pair as well to blacklist if token is blacklisted
                            $blacklist = BlacklistModel::where('token_address', $token1['token_address'])->get();
                            $blacklist->pair_address = $currentPair;
                            $blacklist->save();
                            $this->info(date('Y-m-d H:i:s').' - Blacklist for...'.$token1['token_name'].' - '.$token1['token_symbol'].' Reason: '.$blacklist->reason);
                        }
                    }
                }
            });
        }

        return $pairs;
    }

    public function run()
    {
        $this->info($this->getDateAndTime().' - Listening for new tokens created... ');
        $block_minted = 5; // for now its hardcoded, but it should be dynamic
        while (true) {
            $this->getLatestPairs();
            //sleep interval should be how much time it takes to mine a block
            sleep($block_minted);
        }
    }
}
