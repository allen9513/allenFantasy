<?php

use App\Http\Controllers\LeagueController; 
use App\Http\Controllers\UserController; 
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get(
    'admin/leagueConfig',
     [
        LeagueController::class, 
        'leagueConfig'
     ]
);

Route::post(
    '/authenticate',
    [
        UserController::class, 
        'authenticate',
    ]
);

Route::post(
    '/logout',
    [
        UserController::class, 
        'logout',
    ]
);