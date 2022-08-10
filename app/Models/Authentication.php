<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authentication extends Model
{
    protected $table = 'authentication';
    protected $fillable = [
        'name', 
        'accessToken', 
        'refreshToken', 
        'expiresIn'
    ];
}
