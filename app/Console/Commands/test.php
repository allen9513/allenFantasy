<?php
 
namespace App\Console\Commands;
 
use App\Http\Controllers\YahooOAuth2; 
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
 
class Test extends Command
{

    protected $signature = 'test-command';
    protected $description = 'test';

    public function handle()
    {
        print('test');
    }
}