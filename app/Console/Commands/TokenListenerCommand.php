<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\TokenListenerService;

class TokenListenerCommand extends Command
{
    private $tokenListenerService;

    public function __construct()
    {
        parent::__construct();
        $this->tokenListenerService = new TokenListenerService();
    }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'token-listener:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start listening for new tokens created';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Listening for new tokens created...');
        $this->tokenListenerService->run();
    }
}
