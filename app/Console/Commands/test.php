<?php
 
namespace App\Console\Commands;

use App\Http\Controllers\FantasyGamesController;
use App\Http\Controllers\AuthorizationController; 
use App\Models\Authentication;
use App\Models\FantasyGames;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
 
class Test extends Command
{

    protected $signature = 'test-command';
    protected $description = 'test';

    public function handle()
    {
        $games = FantasyGames::get();

        foreach ($games as $game) {
            print_r($game->gameId . PHP_EOL);
        }
    }
}