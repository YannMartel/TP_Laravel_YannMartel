<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Admin;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::Get('/films', 'App\Http\Controllers\filmController@index');

Route::Get('/films/{id}', 'App\Http\Controllers\filmController@filmAvecCritique');

Route::Get('/acteurs/{id}', 'App\Http\Controllers\filmController@acteurPourUnFilm');

Route::Post('/user/register', 'App\Http\Controllers\userController@register');

Route::post('/user/login', 'App\Http\Controllers\UserController@login');

Route::middleware('auth:sanctum')->get('/user', 'App\Http\Controllers\UserController@show');

Route::middleware('auth:sanctum')->post('/critic', 'App\Http\Controllers\criticController@store');

Route::Post('/films/add', 'App\Http\Controllers\filmController@ajoutFilm')->middleware('auth:sanctum')->middleware(Admin::class);

Route::delete('/films/delete/{id}', 'App\Http\Controllers\filmController@deleteFilm')->middleware('auth:sanctum')->middleware(Admin::class);

Route::middleware('auth:sanctum')->put('/user/logout', 'App\Http\Controllers\userController@logout' );

Route::middleware('auth:sanctum')->put('/user/profilUpdate', 'App\Http\Controllers\userController@profilupdate' );

Route::middleware('auth:sanctum')->put('/user/passwordUpdate', 'App\Http\Controllers\userController@passwordUpdate' );