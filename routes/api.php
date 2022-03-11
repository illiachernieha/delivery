<?php

use App\Http\Controllers\OrderController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::post('/orders/v1/createOrder', [OrderController::class, 'createOrder'])->name('createOrder');

Route::patch('/orders/v1/updateOrder/{orderId}', [OrderController::class, 'updateOrder']);

Route::get('/orders/v1/getOrders', [OrderController::class, 'getOrders']);

Route::get('/orders/v1/getDelayedOrders', [OrderController::class, 'getDelayedOrders']);
