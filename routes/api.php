<?php

use App\Http\Controllers\Api\DishesApiController;
use App\Http\Controllers\Api\RestaurantsApiController;
use App\Http\Controllers\Api\TipologiesApiController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function() {
    Route::get('/restaurants', [RestaurantsApiController::class, 'index']);
});

Route::group(['prefix' => 'v1'], function() {
    Route::get('/details', [DishesApiController::class, 'index']);
});

Route::group(['prefix' => 'v1'], function() {
    Route::get('/tipologies', [TipologiesApiController::class, 'index']);
});