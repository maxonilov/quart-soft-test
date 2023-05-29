<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PaymentController;
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

Route::post('login', [AuthController::class, 'login']);
Route::prefix('payments')->group(function () {
    Route::post('callback/{paymentMethod}', [PaymentController::class, 'callback']);
});
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('payments')->group(function () {
        Route::post('pay', [PaymentController::class, 'pay']);
    });
    Route::resource('articles', ArticleController::class)->only(['store']);
});
