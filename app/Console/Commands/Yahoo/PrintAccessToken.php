<?php

namespace App\Console\Commands\Yahoo;

use App\Http\Controllers\YahooController; 
use Illuminate\Console\Command;

class PrintAccessToken extends Command
{
    protected $signature = 'yahoo:printAccessToken {authCode}';
    protected $description = 'Print access token, passing in the auth code';

    public function handle()
    {
        $yahoo = new YahooController(); 
        print_r($yahoo->getAccessToken($this->argument('authCode')));
    }
}
