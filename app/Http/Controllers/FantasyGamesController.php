<?php

namespace App\Http\Controllers;
 
use App\Models\FantasyGames;

class FantasyGamesController extends AuthorizationController {

    public function storeGames()
    {
        $games = $this->getGames();

        foreach ($games as $game) {
            FantasyGames::updateOrCreate(
                ['gameId' => $game->game_id],
                [
                    'gameKey' => $game->game_key,
                    'gameId' => $game->game_id,
                    'name' => $game->name,
                    'code' => $game->code,
                    'type' => $game->type,
                    'url' => $game->url,
                    'season' => $game->season,
                    'isRegistrationOver' => $game->is_registration_over,
                    'isGameOver' => $game->is_game_over,
                    'isOffseason' => $game->is_offseason,
                    'editorialSeason' => $game->editorial_season ?? null,
                    'picksStatus' => $game->picks_status ?? null,
                    'scenarioGenerator' => $game->scenario_generator ?? null,
                    'contestGroupId' => $game->contest_group_id ?? null,
                    'currentWeek' => $game->current_week ?? null,
                    'isContestRegActive' => $game->is_contest_reg_active ?? null,
                    'isContestOver' => $game->is_contest_over ?? null,
                    'hasSchedule' => $game->has_schedule ?? null,
                    'isLiveDraftLobbyActive' => $game->is_live_draft_lobby_active ?? null,
                ]
            );
        }
    }

    private function getGames() 
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
}

?>