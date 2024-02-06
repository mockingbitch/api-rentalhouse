<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\TagController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' => ['language']], function () {
//    NON LOGGED IN
    Route::controller(AuthController::class)->group(function () {
        Route::get('login', 'requireLogin')->name('login');
        Route::post('login','login');
        Route::post('register', 'register');
    });
    Route::resource('tag', TagController::class)->only(['index', 'show']);
    Route::resource('category', CategoryController::class)->only(['index', 'show']);

//    LOGGED IN
    Route::group(['middleware' => 'auth:api'], function () {
        Route::controller(AuthController::class)->group(function () {
            Route::get('user','show');
            Route::get('logout','logout');
        });
        Route::controller(UserController::class)->group(function () {
            Route::get('information', 'information');
        });
        Route::resource('tag', TagController::class);
        Route::resource('category', CategoryController::class);
    });
});
