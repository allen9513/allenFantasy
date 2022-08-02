<?php

namespace App\Console\Commands\Yahoo;

use App\Http\Controllers\YahooController; 
use Illuminate\Console\Command;

class PrintAuthUrl extends Command
{
    protected $signature = 'yahoo:printAuthUrl';
    protected $description = 'Print URL for Yahoo API auth code';

    public function handle()
    {
        $yahoo = new YahooController();
        print($yahoo->getAuthorizationURL());
    }
}
