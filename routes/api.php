<?php

use Illuminate\Http\Request;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CheckoutController;
use Illuminate\Support\Facades\Route;


    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', function (Request $request) {
            return $request->user();
        });

        Route::get('products', [ProductController::class, 'index']);
        Route::get('products/{product}', [ProductController::class, 'show']);
        Route::post('products', [ProductController::class, 'store']);

        Route::post('cart/add', [CartController::class, 'addToCart']);
        Route::delete('cart/remove/{cartId}', [CartController::class, 'removeFromCart']);
        Route::get('cart', [CartController::class, 'viewCart']);
        Route::put('cart/edit/{cartId}', [CartController::class, 'editCart']);


        Route::post('place-order', [CheckoutController::class, 'placeOrder']);

        Route::post('logout', [AuthController::class, 'logout']);
    });