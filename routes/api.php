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

Route::get('/sites/','SiteController@getSites');
Route::post('/sites/add','SiteController@addSites');
Route::get('/sites/list','SiteController@getSites');


/***************   SITE SSL ROUTES  *******************/

Route::get('/sites/ssl/sites','SiteController@getSites_SSL');
Route::post('sites/ssl/check','SiteController@SSLCheck');
Route::post('/sites/ssl/enable','SiteController@enableSSL');

/***************   END SITE SSL ROUTES  *******************/

Route::post('/sites/git','SiteController@addRepo');