<?php

use App\Http\Controllers\Api\RoomController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HouseController;
use App\Http\Controllers\Api\CategoryController;
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
    Route::resource('house', HouseController::class)->only(['index', 'show']);
    Route::resource('room', RoomController::class)->only(['index', 'show']);

//    LOGGED IN
    Route::group(['middleware' => 'auth:api'], function () {
        Route::controller(AuthController::class)->group(function () {
            Route::get('logout','logout');
        });
        Route::controller(UserController::class)->group(function () {
            Route::put('user', 'update');
            Route::get('information', 'information');
        });
        Route::resource('tag', TagController::class)->except(['index', 'show']);
        Route::resource('category', CategoryController::class)->except(['index', 'show']);
        Route::resource('house', HouseController::class)->except(['index', 'show']);
        Route::resource('room', RoomController::class)->except(['index', 'show']);
    });
});
