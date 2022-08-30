<?php

namespace App\Http\Controllers;

use App\Models\FantasyGames;
use App\Models\Leagues;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

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

    public function createLeague(Request $request)
    {

        try {
            Leagues::create([
                'leagueId' => $request->leagueId,
                'gameKey' => $request->gameKey,
                'nickname' => $request->leagueNickname,
            ]);
        } catch(QueryException $e) {
            $errorCode = $e->errorInfo[1];

            if ($errorCode == 1062) {
                return back()->withErrors([
                    'errorMessage' => 'gamekey/nickname already exists',
                ]);
            }
            if ($errorCode == 1452) {
                return back()->withErrors([
                    'errorMessage' => 'gamekey does not exist',
                ]);
            }
            return back()->withErrors([
                'errorMessage' => 'could not add league, unknown error',
            ]);
        }

        return redirect()->back()->with('successMessage', 'League successfully added');
    }

    public function deleteLeague(Request $request)
    {
        try {
            $league = Leagues::where('leagueId', $request->leagueId)
                ->where('gameKey', $request->gameKey)
                ->where('nickname', $request->leagueNickname)
                ->first();

            $league->delete();
        } catch(QueryException $e) {
            return back()->withErrors([
                'errorMessage' => 'Error deleteing league',
            ]);
        }
        
        return redirect()->back()->with('successMessage', 'League successfully deleted');
    }
}
