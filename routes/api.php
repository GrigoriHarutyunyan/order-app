<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\OrderController AS Order;

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

Route::get('/get-order/{id}', [Order::class, 'getOrderById']);
Route::match(['get', 'post'], '/orders', [Order::class, 'index']);
Route::patch('orders/{id}', [Order::class, 'update']);
Route::post('orders/store', [Order::class, 'store']);
