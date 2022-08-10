<?php

namespace App\Console\Commands\Yahoo;

use App\Http\Controllers\AuthorizationController; 
use Illuminate\Console\Command;

class PrintAccessToken extends Command
{
    protected $signature = 'yahoo:printAccessToken {authCode}';
    protected $description = 'Print access token, passing in the auth code';

    public function handle()
    {
        $client = new AuthorizationController(); 
        $client->setAuth($this->argument('authCode'));
    }
}
