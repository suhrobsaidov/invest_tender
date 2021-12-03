<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AnouncementsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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

Route::group([
    'middleware' => ['api','cors'],
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
  /*  Route::get('/user' , [UserController::class , 'profile]);*/
    Route::get('/myanouncements', [AnouncementsController::class ,'myAnouncements']);
    Route::get('/allanouncements', [AnouncementsController::class ,'allAnouncements']);
    Route::post('/anouncements', [AnouncementsController::class ,'createAnouncements']);
    Route::put('/profile/update/{id}', [ProfileController::class, 'update']);


});

