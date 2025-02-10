<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);
Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register']);

// Product Routes
Route::get('/products', [App\Http\Controllers\API\ProductController::class, 'index'])->middleware('auth:sanctum');
Route::get('/products/{id}', [App\Http\Controllers\API\ProductController::class, 'show'])->middleware('auth:sanctum');
Route::get('/recent-products', [App\Http\Controllers\API\ProductController::class, 'recentProducts'])->middleware('auth:sanctum');

// Cart Routes
Route::get('/cart', [App\Http\Controllers\API\CartController::class, 'index'])->middleware('auth:sanctum'); 
Route::post('/cart/add/{id}', [App\Http\Controllers\API\CartController::class, 'addToCart'])->middleware('auth:sanctum');
Route::delete('/cart/{id}', [App\Http\Controllers\API\CartController::class, 'remove'])->middleware('auth:sanctum');
Route::patch('/cart/{id}', [App\Http\Controllers\API\CartController::class, 'update'])->middleware('auth:sanctum');

// Checkout Routes
Route::get('/checkout', [App\Http\Controllers\API\CheckoutController::class, 'index'])->middleware('auth:sanctum');
Route::post('/process', [App\Http\Controllers\API\CheckoutController::class, 'process'])->middleware('auth:sanctum');
Route::get('/success', [App\Http\Controllers\API\CheckoutController::class, 'success'])->middleware('auth:sanctum');
Route::get('/cancel', [App\Http\Controllers\API\CheckoutController::class, 'cancel'])->middleware('auth:sanctum');