<?php

use App\Http\Controllers\Api\User\CategoryController;
use App\Http\Controllers\Api\User\HouseController;
use App\Http\Controllers\Api\User\RoomController;
use App\Http\Controllers\Api\User\TagController;
use App\Http\Controllers\Api\AuthController;
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
    Route::controller(AuthController::class)->group(function () {
        Route::get('login', 'requireLogin')->name('login');
        Route::post('login','login');
        Route::post('register', 'register');
    });
    Route::resource('tag', TagController::class)->only(['index', 'show']);
    Route::resource('category', CategoryController::class)->only(['index', 'show']);
    Route::resource('house', HouseController::class)->only(['index', 'show']);
    Route::resource('room', RoomController::class)->only(['index', 'show']);
});
