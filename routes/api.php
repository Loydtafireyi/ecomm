<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\TopupController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::middleware('auth:api')->post('/logout', [AuthController::class, 'logout']);

Route::get('products', [ProductController::class, 'index']);
Route::get('product/{product}', [ProductController::class, 'show']);

Route::middleware('auth:api')->post('topup', [TopupController::class, 'store']);
Route::middleware('auth:api')->get('topups', [TopupController::class, 'index']);
Route::middleware('auth:api')->post('checkout/{slug}', CheckoutController::class);
Route::middleware('auth:api')->get('orders', OrderController::class);


