<?php

namespace App\Console\Commands\Yahoo;

use App\Http\Controllers\YahooClient; 
use Illuminate\Console\Command;

class PrintAccessToken extends Command
{
    protected $signature = 'yahoo:printAccessToken {authCode}';
    protected $description = 'Print access token, passing in the auth code';

    public function handle()
    {
        $client = new YahooClient(); 
        $client->setAuth($this->argument('authCode'));
    }
}
