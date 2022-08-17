<?php

namespace App\Console\Commands\Yahoo;

use App\Http\Controllers\AuthorizationController; 
use Illuminate\Console\Command;

class InitialSetup extends Command
{
    protected $signature = 'yahoo:initialSetup';
    protected $description = 'Command description';

    public function handle()
    {
        $authClient = new AuthorizationController();
        print($authClient->getAuthURL());
    }
}
