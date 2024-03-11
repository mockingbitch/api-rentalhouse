<?php

use App\Enum\General;
use App\Http\Controllers\Api\Admin\CategoryController;
use App\Http\Controllers\Api\Admin\HouseController;
use App\Http\Controllers\Api\Admin\RoomController;
use App\Http\Controllers\Api\Admin\TagController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

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
    Route::group(['middleware' => 'auth:api'], function () {
        Route::group(['middleware' => 'author:' . General::ROLE_LESSOR], function () {
//            Route::controller(AuthController::class)->group(function () {
//                Route::get('logout','logout');
//            });
//            Route::controller(UserController::class)->group(function () {
//                Route::put('user', 'update');
//                Route::get('information', 'information');
//            });
            Route::resource('house', HouseController::class);
            Route::resource('room', RoomController::class);

            Route::group(['middleware' => 'author:' . General::ROLE_LESSOR], function () {
                Route::resource('tag', TagController::class);
                Route::resource('category', CategoryController::class);
            });
        });
    });
});
