<?php

namespace App\Console\Commands\Yahoo;

use App\Http\Controllers\YahooClient; 
use Illuminate\Console\Command;

class PrintAuthUrl extends Command
{
    protected $signature = 'yahoo:printAuthUrl';
    protected $description = 'Print URL for Yahoo API auth code';

    public function handle()
    {
        $client = new YahooClient();
        print($client->getAuthURL());
    }
}
