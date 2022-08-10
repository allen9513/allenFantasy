<?php
 
namespace App\Console\Commands;

use App\Http\Controllers\FantasyClient;
use App\Http\Controllers\YahooClient; 
use App\Models\Authentication;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
 
class Test extends Command
{

    protected $signature = 'test-command';
    protected $description = 'test';

    public function handle()
    {
        $client = new YahooClient();
        
        $codes = $client->getAuth();
        print_r($codes);
    }
}