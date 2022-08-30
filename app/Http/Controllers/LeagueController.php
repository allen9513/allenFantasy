<?php

namespace App\Http\Controllers;

use App\Models\FantasyGames;
use App\Models\Leagues;
use Illuminate\Database\QueryException;

class LeagueController extends FantasyGamesController
{
    public function test() 
    {
        return 'asdf';
    }

    public function getLeaguesFromYahoo() 
    {
        print('asdf');
        /* $url = 'league/414.l.5623/?format=json';
        $leagueRequest = $this->getRequest($url);
        dd($leagueRequest); */
    }

    public function leagueConfig($message=[])
    {
        $fantasyGames = FantasyGames::get();
        $leagues = Leagues::get();

        foreach ($fantasyGames as $fantasyGame) {

        }

        return view(
            'admin.leagueConfig', 
            [
                'fantasyGames' => $fantasyGames,
                'leagues' => $leagues,
                'message' => $message,
            ]
        );
    }

    public function createLeague()
    {
        try {
            Leagues::create([
                'leagueId' => 'test',
                'gameKey' => '406',
                'nickname' => 'test',
            ]);
        } catch(QueryException $e) {
            $errorCode = $e->errorInfo[1];

            if ($errorCode == 1062) {
                $this->leagueConfig(['error' => 'gamekey/nickname already exists']);
            }
            if ($errorCode == 1452) {
                $this->leagueConfig(['error' => 'gamekey does not exist']);
            }
            $this->leagueConfig(['error' => 'could not add game key, unknown error']);
        }
    }
}
