<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leagues extends Model
{
    protected $table = 'leagues';
    protected $fillable = [
        'leagueId', 
        'gameKey',
        'nickname', 
    ];
}
