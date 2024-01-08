<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Configurations as ConfigurationsModel;

class ConfigurationSeeder extends Seeder
{
    /**
     * Seed the application's configurations table.
     */

    public function getConfigurations(): array
    {
        return [
            [
                'name'=>'http_provider_endpoint',
                'value'=>'https://chaotic-wild-violet.discover.quiknode.pro/10fe71635bbc8a69149516c36791e11a39390064/',
                'description'=>'The endpoint of the HTTP provider to connect to the Ethereum network',
                'type'=>'string',
                'group'=>'web3'
            ],
            [
                'name'=>'eth_blocknumber',
                'value'=>'',
                'description'=>'The latest block number of the Ethereum network',
                'type'=>'integer',
                'group'=>'web3'
            ],
            [
                'name'=>'eth_blocktime',
                'value'=>'',
                'description'=>'The average time it takes to mine a block on the Ethereum network(in seconds)',
                'type'=>'integer',
                'group'=>'web3'
            ],
            [
                'name'=>'uniswap_pairs_count',
                'value'=>'',
                'description'=>'The number of pairs on Uniswap V2',
                'type'=>'integer',
                'group'=>'web3'
            ],
        ];
    }

    public function run()
    {
        foreach ($this->getConfigurations() as $configuration) {
            ConfigurationsModel::firstOrNew($configuration, ['name' => $configuration['name']])->save();
        }
    }
}
