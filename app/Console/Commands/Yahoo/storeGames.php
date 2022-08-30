<?php

namespace App\Console\Commands\Yahoo;

use App\Http\Controllers\FantasyGamesController;
use Illuminate\Console\Command;

class storeGames extends Command
{
    protected $signature = 'yahoo:storeGames';
    protected $description = 'Get games from yahoo and store them in the database';

    public function handle()
    {
        $gamesClient = new FantasyGamesController;
        $gamesClient->storeGames();
    }
}
