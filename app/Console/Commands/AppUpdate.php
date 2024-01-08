<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AppUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Updating application...');
        $this->call('migrate');
        $this->call('db:seed');
        $this->call('token-listener:start');
        $this->info('Application updated!');
    }
}
