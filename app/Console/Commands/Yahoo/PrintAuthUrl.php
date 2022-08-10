<?php

namespace App\Console\Commands\Yahoo;

use App\Http\Controllers\AuthorizationController; 
use Illuminate\Console\Command;

class PrintAuthUrl extends Command
{
    protected $signature = 'yahoo:printAuthUrl';
    protected $description = 'Print URL for Yahoo API auth code';

    public function handle()
    {
        $client = new AuthorizationController();
        print($client->getAuthURL());
    }
}
