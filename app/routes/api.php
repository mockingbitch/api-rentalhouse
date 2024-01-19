<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Http\Controllers\AccessTokenController;

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
//Route::post('auth/token', [AccessTokenController::class, 'issueToken']);
//Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::group(['middleware' => 'auth:api'], function() {
//    Route::post('details', [UserController::class, 'details']);
    Route::get('test', [UserController::class, 'test']);
});

Route::controller(AuthController::class)->group(function(){
    Route::post('login','loginUser');
});

Route::controller(AuthController::class)->group(function(){
    Route::get('user','getUserDetail');
    Route::get('logout','userLogout');
})->middleware('auth:api');
