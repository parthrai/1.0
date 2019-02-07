<?php

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


Route::get('/test', function () {
    return view('test');
});



Route::get('/setup','SetupController@index');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/updateCompanyName','SetupController@setup');
Route::post('/addAdminUser','SetupController@addAdminUsers');


Route::post('addSite','SiteController@addSites');
Route::post('/sites/add','SiteController@addSites');
Route::post('/sites/import','SiteController@importSites');


Route::get('/site/{site_id}','SiteContentController@get');



// Analytics Routes


Route::get('/analytics','AnalyticsController@test');