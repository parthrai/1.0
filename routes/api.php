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


Route::get('users','UserController@getUsers');
Route::post('users/delete','UserController@deleteUsers');

Route::get('/sites/','SiteController@index');
Route::post('/sites/add','SiteController@addSites');
Route::get('/sites/list','SiteController@getSites');

Route::post('/sites/ssl/enable','SiteController@enableSSL');
Route::get('/sites/ssl/disable','SiteController@disableSSL');


Route::get('/sites/git','SiteController@addRepo');