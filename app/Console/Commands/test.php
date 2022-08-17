<?php
 
namespace App\Console\Commands;

use App\Http\Controllers\FantasyGamesController;
use App\Http\Controllers\AuthorizationController; 
use App\Http\Controllers\LeagueController; 
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
        $lc = new LeagueController;
        $fg = new FantasyGamesController;
        //print_r($fg->getGames());
        //print_r($lc->getLeaguesFromYahoo());
        $lc->createLeague();
    }
}