<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FantasyGames extends Model
{
    protected $table = 'fantasyGames';
    protected $fillable = [
        'gameKey', 
        'gameId',
        'name', 
        'code',
        'type', 
        'url',
        'season', 
        'isRegistrationOver',
        'isGameOver', 
        'isOffseason',
        'editorialSeason', 
        'picksStatus',
        'scenarioGenerator', 
        'contestGroupId',
        'currentWeek', 
        'isContestRegActive',
        'isContestOver', 
        'hasSchedule',
        'isLiveDraftLobbyActive', 
    ];
}
