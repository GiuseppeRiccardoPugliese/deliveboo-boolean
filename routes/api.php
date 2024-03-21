<?php

use App\Http\Controllers\Api\ApiDataController;
use App\Http\Controllers\Api\DishesApiController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RestaurantsApiController;
use App\Http\Controllers\Api\TipologiesApiController;
use App\Http\Controllers\OrderController;

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

// Route::group(['prefix' => 'v1'], function() {
//     Route::get('/restaurants', [RestaurantsApiController::class, 'index']);
// });

Route::group(['prefix' => 'v1'], function () {
    Route::get('/details', [DishesApiController::class, 'index']);
});

Route::group(['prefix' => 'v1'], function () {
    Route::get('/tipologies', [TipologiesApiController::class, 'index']);
});

Route::group(['prefix' => 'v1'], function () {
    Route::get('/deliveboo', [ApiDataController::class, 'Data']);

    //ROTTA PER I FILTRI SULLE TIPOLOGIE
    Route::post('filtered', [ApiDataController::class, 'filteredTipology']);
});

//Rotte per il pagamento
Route::get('generate', [PaymentController::class, 'generate']); //PRENDO IL TOKEN
Route::post('make/payment', [PaymentController::class, 'makePayment']); //MANDO IL PAGAMENTO
Route::get('products', [ProductController::class, 'index']);

Route::put('/orders/{id}', [OrderController::class, 'update']);

