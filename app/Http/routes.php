<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');
Route::get('/random', 'HomeController@getRandomPage');

Route::get('/search/{query}', 'SearchController@performSearch');

Route::get('/bookmarks', 'BookmarkController@index');
Route::get('/bookmarks/create/{chapterSlug}/{pageSlug?}', 'BookmarkController@create');
Route::get('/bookmarks/delete/{chapterSlug}/{pageSlug?}', 'BookmarkController@delete');

//Data driven pages requiring controllers
Route::get('/chapter/mayden-servers/server-list/{id?}', 'ServerController@showPage');
Route::get('/chapter/iaptus-services/service-list/{id?}', 'ServiceController@showPage');

//Static content pages - catch all
Route::get('/chapter/{chapterSlug}', 'ChapterController@show');
Route::get('/chapter/{chapterSlug}/{pageSlug}', 'PageController@show');
