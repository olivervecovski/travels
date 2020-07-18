<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/auth/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->get('/user/trips', 'TripController@trips');

Route::apiResource('/trips', 'TripController');

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function($router) {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::get('social/{provider}', 'AuthController@redirectToProvider');
    Route::get('social/{provider}/callback', 'AuthController@handleProviderCallback');
});
