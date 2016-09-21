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

Route::get('login', 'Auth\AuthController@redirectToProvider');
Route::get('logout', 'Auth\AuthController@logout');
Route::get('/login/callback', 'Auth\AuthController@handleProviderCallback');
Route::get('/login/retry', 'Auth\AuthController@retryLogin');
Route::get('/accessdenied', 'Auth\AuthController@accessDeniedPage');

Route::group(['middleware' => ['auth']], function () {

    Route::get('/', 'HomeController@index');
    
    Route::get('/contributors', 'HomeController@contributors');
    Route::get('/random', 'HomeController@getRandomPage');
    Route::get('/switchcategory/{id}', 'HomeController@switchCategory');

    Route::get('/search/{query}', 'SearchController@performSearch');
    Route::get('/search/{query}/results', 'SearchController@showSearchResults');
    Route::get('/related/{query}', 'RelatedController@getRelatedResources');
    Route::get('/related/{query}/results', 'RelatedController@showRelatedResults');

    Route::get('/pages/create', 'PageController@create');
    Route::post('/pages', 'PageController@store');
    Route::get('/pages/edit/{id}', 'PageController@edit');
    Route::put('/pages/{id}', 'PageController@update');
    Route::delete('/pages/{id}', 'PageController@destroy');
    Route::get('/pages/latestupdates', 'PageController@latestPages');
    
    Route::get('/chapters/create', 'ChapterController@create');
    Route::post('/chapters', 'ChapterController@store');
    Route::get('/chapters/edit/{id}', 'ChapterController@edit');
    Route::put('/chapters/{id}', 'ChapterController@update');
    Route::delete('/chapters/{id}', 'ChapterController@destroy');

    Route::get('/curation', 'CurationController@index');
    Route::get('/curation/new', 'CurationController@newPagesAwaitingApproval');
    Route::get('/curation/edits', 'CurationController@suggestedEditsAwaitingApproval');
    Route::get('/curation/viewdiff/{id}', 'CurationController@viewdiff');
    Route::get('/curation/new/approve/{id}', 'CurationController@approveNewPage');
    Route::get('/curation/new/reject/{id}', 'CurationController@rejectNewPage');
    Route::get('/curation/edits/approve/{id}', 'CurationController@approveSuggestedEdit');
    Route::get('/curation/edits/approve/{id}', 'CurationController@approveEdit');
    Route::get('/curation/edits/reject/{id}', 'CurationController@rejectEdit');

    Route::get('/ajax/modal/server/{id}', 'ServerController@showServerModal');
    Route::get('/ajax/modal/badges/{id}', 'BadgeController@showBadgeModal');
    Route::get('/ajax/data/chapters/{category_id}', 'ChapterController@getChaptersForCategory');

    //Data driven pages requiring controllers
    Route::get('/p/mayden/servers/server-details/{id?}', 'ServerController@show');
    Route::get('/p/mayden/servers/ssh-config-generator', 'ServerController@configGenerator');
    Route::post('/p/mayden/servers/ssh-config-generator', 'ServerController@generateConfig');
    Route::get('/p/{chapterSlug}/services/service-list/{id?}', 'ServiceController@show');

    Route::get('/u/{userSlug}/', 'UserController@show');

    if (env('FEATURE_BADGES_ENABLED', true)) {
        Route::get('/u/{userSlug}/badges', 'BadgeController@index');
    }

    // Route::group(['middleware' => ['mine']], function () {
        Route::post('/u/{slug}/drafts/{id?}', 'PageDraftController@store');
        Route::get('/u/{slug}/drafts', 'PageDraftController@index');
        Route::get('/u/{slug}/drafts/{id}', 'PageDraftController@edit');
        Route::get('/u/{slug}/drafts/preview/{id}', 'PageDraftController@preview');
        Route::get('/u/{slug}/drafts/delete/{id}', 'PageDraftController@destroy');

        Route::get('/u/{slug}/bookmarks', 'BookmarkController@index');
        Route::get('/u/{slug}/bookmarks/create/{categorySlug}/{chapterSlug}/{pageSlug?}', 'BookmarkController@create');
        Route::get('/u/{slug}/bookmarks/delete/{categorySlug}/{chapterSlug}/{pageSlug?}', 'BookmarkController@destroy');
    // });
        Route::get('/rankings', 'RankController@index');
    
    //Static content pages - catch all
    Route::get('/p/{categorySlug}/{chapterSlug}/{pageSlug}', 'PageController@show');
    Route::get('/p/{categorySlug}/{chapterSlug}', 'ChapterController@show');
    Route::get('/p/{categorySlug}/', 'CategoryController@show');
});
