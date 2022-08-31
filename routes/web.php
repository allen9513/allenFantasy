<?php

use App\Http\Controllers\LeagueController; 
use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureUserIsAdmin;
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
)->middleware(EnsureUserIsAdmin::class);

Route::post(
    'admin/createLeague',
     [
        LeagueController::class, 
        'createLeague'
     ]
)->middleware(EnsureUserIsAdmin::class);

Route::post(
    'admin/deleteLeague',
     [
        LeagueController::class, 
        'deleteLeague'
     ]
)->middleware(EnsureUserIsAdmin::class);

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

Route::get(
    'admin/userManagement',
     [
        UserController::class, 
        'userManagement'
     ]
)->middleware(EnsureUserIsAdmin::class);

Route::post(
    'admin/addUser',
    [
        UserController::class, 
        'addUser',
    ]
)->middleware(EnsureUserIsAdmin::class);;

Route::post(
    'admin/editUser',
    [
        UserController::class, 
        'editUser',
    ]
)->middleware(EnsureUserIsAdmin::class);;

Route::post(
    'admin/deleteUser',
    [
        UserController::class, 
        'deleteUser',
    ]
)->middleware(EnsureUserIsAdmin::class);;
