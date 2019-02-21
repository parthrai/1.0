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




/***************   DAHBOARD ROUTES  *******************/

Route::get('dashboard','DashboardController@getStats');


/***************  END DAHBOARD ROUTES  *******************/





/***************   SITE CRUD ROUTES  *******************/


Route::get('/sites/','SiteController@getSites');
Route::post('/sites/add','SiteController@addSites');
Route::get('/sites/list','SiteController@getSites');


Route::post('/sites/delete','SiteController@deleteSite');

/***************  END SITE CRUD ROUTES  *******************/

/***************   SITE SSL ROUTES  *******************/

Route::get('/sites/ssl/sites','SiteController@getSites_SSL');
Route::post('sites/ssl/check','SiteController@SSLCheck');
Route::post('/sites/ssl/enable','SiteController@enableSSL');

/***************   END SITE SSL ROUTES  *******************/

Route::post('/sites/git','SiteController@addRepo');
Route::post('/sites/deploy','SiteController@deploy');

/***************   ANALYTICS ROUTES  *******************/


Route::get('/analytics/pageViews','AnalyticsController@VisitorsAndPageViews');

/***************   END ANALYTICS ROUTES  *******************/




Route::get('test','SiteContentController@test');
Route::get('test2/{site_id}','SiteContentController@add');
Route::post('test3','SiteContentController@test3');