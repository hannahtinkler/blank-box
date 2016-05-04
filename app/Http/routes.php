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

Route::get('/', ['as' => 'search', 'uses' => function() {

  // Check if user has sent a search query
    // Use the Elasticquent search method to search ElasticSearch
    $pages = App\Library\Models\Page::search('love process');

  dd($pages);
}]);

// Route::get('/', 'HomeController@index');
// Route::get('/random', 'HomeController@getRandomPage');

// Route::get('/search/{query}', 'SearchController@performSearch');

// Route::get('/bookmarks', 'BookmarkController@index');
// Route::get('/bookmarks/create/{categorySlug}/{chapterSlug}/{pageSlug?}', 'BookmarkController@create');
// Route::get('/bookmarks/delete/{categorySlug}/{chapterSlug}/{pageSlug?}', 'BookmarkController@delete');

// //Data driven pages requiring controllers
// Route::get('/p/mayden/servers/server-details/{id?}', 'ServerController@showPage');
// Route::get('/p/mayden/servers/ssh-config-generator', 'ServerController@configGenerator');
// Route::post('/p/mayden/servers/ssh-config-generator', 'ServerController@generateConfig');
// Route::get('/p/iaptus/services/service-details/{id?}', 'ServiceController@showPage');

// //Static content pages - catch all
// Route::get('/p/{categorySlug}/{chapterSlug}/{pageSlug}', 'PageController@show');
// Route::get('/p/{categorySlug}/{chapterSlug}', 'ChapterController@show');
// Route::get('/p/{categorySlug}/', 'CategoryController@show');
