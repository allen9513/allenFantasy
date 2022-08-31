<?php
 
namespace App\Console\Commands;

use Illuminate\Console\Command;
 
class Test extends Command
{

    protected $signature = 'test-command';
    protected $description = 'test';

    public function handle()
    {
        print('test');
    }
}