<?php
 
namespace App\Console\Commands;
 
use App\Http\Controllers\YahooController; 
use App\Models\Authentication;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
 
class Test extends Command
{

    protected $signature = 'test-command';
    protected $description = 'test';

    public function handle()
    {
        $y = new YahooController();
        print_r($y->storeAccessTokens());
    }
}