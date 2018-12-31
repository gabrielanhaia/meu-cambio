<?php

use Illuminate\Http\Request;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'Api\V1\AuthController@login');
    Route::post('logout', 'Api\V1\AuthController@logout');
    Route::post('refresh', 'Api\V1\AuthController@refresh');
    Route::post('me', 'Api\V1\AuthController@me');
});

Route::group([
    'middleware' => ['api', 'auth:api'],
    'prefix' => 'news'
], function ($router) {
    Route::get('', 'Api\V1\FeedController@listNews');
    Route::get('{identifier}', 'Api\V1\FeedController@showNews');
});