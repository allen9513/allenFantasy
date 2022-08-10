<?php

namespace App\Http\Controllers;
 
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\ClientException;

class FantasyClient extends YahooClient {

    public function getGames() 
    {
        $url = 'users;use_login=1/games;game_keys/?format=json';
        $gamesRequest = $this->getRequest($url);
        $users = $gamesRequest->fantasy_content->users;
        $gamesArray = [];

        foreach ($users as $user) {
            //ignore $users->count
            if (is_int($user)) {
                continue;
            }
            //not sure why there would be more than one user
            $games = $user->user[1]->games;

            foreach ($games as $game) {
                //ignore count again
                if (is_int($game)) {
                    continue;
                }
                //fantasy leagues are arrays of game objects, brackets
                //and tourney pick'ems are just the objects
                if (is_array($game->game)) {
                    foreach ($game->game as $gameObject) {
                        $gamesArray[] = $gameObject;
                    }
                } else {
                    $gamesArray[] = $game->game;
                }
    
            }
        }

        return $gamesArray;
    }

    private function getRequest($url)
    {
        $auth = $this->getAuth();
        $baseUrl = 'https://fantasysports.yahooapis.com/fantasy/v2/';

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $auth->accessToken,
            'Content-Type' => 'application/x-www-form-urlencoded'
        ])->get($baseUrl . 'users;use_login=1/games;game_keys/?format=json');

        if ($response->failed()) {
            dd(json_decode($response->getBody()->getContents()));
        }

        return json_decode($response->getBody()->getContents());
    }
}

?>