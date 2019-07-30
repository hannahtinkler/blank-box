<?php

use Illuminate\Http\Request;
use League\CommonMark\CommonMarkConverter;

Route::get('/login', 'Auth\AuthController@redirectToProvider');
Route::get('/login/retry', 'Auth\AuthController@retryLogin');
Route::get('/login/callback', 'Auth\AuthController@handleProviderCallback');
Route::get('/logout', 'Auth\AuthController@logout');
Route::get('/accessdenied', 'Auth\AuthController@accessDeniedPage');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index');
    Route::get('/random', 'HomeController@getRandomPage');
    Route::get('/switchcategory/{id}', 'HomeController@switchCategory');

    Route::get('/search/{query}', 'SearchController@performSearch');
    Route::get('/search/{query}/results', 'SearchController@showSearchResults');

    Route::get('/pages/create', 'PageController@create');
    Route::post('/pages', 'PageController@store');
    Route::get('/pages/edit/{id}', 'PageController@edit');
    Route::put('/pages/{id}', 'PageController@update');

    Route::get('/forge-links/{link}/deploy', 'PageForgeLinkController@deploy');
    Route::get('/forge-links/{link}/edit', 'PageForgeLinkController@edit');
    Route::get('/forge-links/{link}/log', 'PageForgeLinkController@log');
    Route::get('/forge-links/{link}/unlink', 'PageForgeLinkController@unlink');
    Route::post('/forge-links', 'PageForgeLinkController@store');

    Route::post('/pageresources', 'PageResourceController@store');
    Route::get('/pageresources/update/{id}', 'PageResourceController@update');
    Route::get('/pageresources/delete/{id}', 'PageResourceController@destroy');
    Route::get('/pageresources/edit/{id}', 'PageResourceController@edit');


    Route::get('/chapters/create', 'ChapterController@create');
    Route::post('/chapters', 'ChapterController@store');

    Route::get('/ajax/data/chapters/{category_id}', 'ChapterController@getChaptersForCategory');
    Route::get('/ajax/actions/minimalise', 'HomeController@minimaliseNavbar');

    Route::get('/u/status', 'UserController@editStatus');
    Route::put('/u/status', 'UserController@updateStatus');

    Route::get('/u/{slug}/', 'UserController@show');
    Route::post('/u/{slug}/drafts/{id?}', 'PageDraftController@store');
    Route::get('/u/{slug}/drafts', 'PageDraftController@index');
    Route::get('/u/{slug}/drafts/{id}', 'PageDraftController@edit');
    Route::get('/u/{slug}/drafts/preview/{id}', 'PageDraftController@preview');
    Route::get('/u/{slug}/drafts/delete/{id}', 'PageDraftController@destroy');

    Route::get('/u/{slug}/bookmarks', 'BookmarkController@index');
    Route::get('/u/{slug}/bookmarks/create/{categorySlug}/{chapterSlug}/{pageSlug?}', 'BookmarkController@create');
    Route::get('/u/{slug}/bookmarks/delete/{categorySlug}/{chapterSlug}/{pageSlug?}', 'BookmarkController@destroy');

    Route::get('/rankings', 'RankingController@index');

    //Static content pages - catch all
    Route::get('/p/{categorySlug}/{chapterSlug}/{pageSlug}', 'PageController@show');
    Route::get('/p/{categorySlug}/{chapterSlug}', 'ChapterController@show');
    Route::get('/p/{categorySlug}/', 'CategoryController@show');

    Route::post('/ajax/endpoints/pagepreview', function (Request $request, CommonMarkConverter $converter) {
        return json_encode([
            'identifier' => $request->input('identifier'),
            'content' => $converter->convertToHtml($request->input('content'))
        ]);
    });

    if (env('FEATURE_BADGES_ENABLED', true)) {
        Route::get('/u/{userSlug}/badges', 'BadgeController@index');
        Route::get('/ajax/modal/badges/{userId}/{badgeId}', 'BadgeController@showBadgeModal');
    }

    if (env('FEATURE_CURATION_ENABLED', true)) {
        Route::group(['middleware' => ['curator']], function () {
            Route::get('/curation', 'CurationController@index');
            Route::get('/curation/new', 'CurationController@newPagesAwaitingApproval');
            Route::get('/curation/edits', 'CurationController@suggestedEditsAwaitingApproval');
            Route::get('/curation/viewdiff/{id}', 'CurationController@viewDiff');
            Route::get('/curation/new/approve/{id}', 'CurationController@approveNewPage');
            Route::get('/curation/new/reject/{id}', 'CurationController@rejectNewPage');
            Route::get('/curation/edits/approve/{id}', 'CurationController@approveSuggestedEdit');
            Route::get('/curation/edits/approve/{id}', 'CurationController@approveEdit');
            Route::get('/curation/edits/reject/{id}', 'CurationController@rejectEdit');

            Route::get('/chapters/edit/{id}', 'ChapterController@edit');
            Route::put('/chapters/{id}', 'ChapterController@update');
            Route::delete('/chapters/{id}', 'ChapterController@destroy');

            Route::delete('/pages/{id}', 'PageController@destroy');
        });
    } else {
        Route::get('/chapters/edit/{id}', 'ChapterController@edit');
        Route::put('/chapters/{id}', 'ChapterController@update');
        Route::delete('/chapters/{id}', 'ChapterController@destroy');

        Route::delete('/pages/{id}', 'PageController@destroy');
    }
});
