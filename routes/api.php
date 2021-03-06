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
Route::prefix('v1')->group(function () {
    Route::get('auth/google', 'Api\Auth\GoogleController@show')->name('google.login');
    Route::get('auth/google/callback', 'Api\Auth\GoogleController@store');
    Route::post('login', 'Api\Auth\AccessController@store');
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('users', 'Api\UsersController@index');
    });
});
