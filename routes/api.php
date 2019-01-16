<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::put('users', 'api\UserController@store');
Route::get('/users', 'api\UserController@index');
Route::get('/users/{user}', 'UserController@show');
Route::delete('/users/{id}', 'UserController@destroy');
Route::post('/users', 'UserController@store');
