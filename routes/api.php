<?php

use App\Http\Resources\UserResource;
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
    $userResource = new UserResource($request->user());
    return $userResource;
});

Route::middleware('auth:api')->get('/user/trips', 'TripController@trips');

Route::apiResource('/trips', 'TripController');
Route::apiResource('/trips/{trip}/destinations', 'DestinationController');

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function($router) {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::post('forgot-password', 'ForgotPasswordController@sendResetLinkEmail');
    Route::post('reset-password', 'ResetPasswordController@reset');
    Route::post('check-token', 'AuthController@checkToken');
    Route::get('email-verification', 'VerificationController@verify')->name('verification.verify');
    Route::get('social/{provider}', 'AuthController@redirectToProvider');
    Route::get('social/{provider}/callback', 'AuthController@handleProviderCallback');
});
