<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartitemController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;




Route::apiResource('books', BookController::class);
Route::apiResource('authors', AuthorController::class);
Route::apiResource('carts', CartController::class);
Route::apiResource('cartitems', CartitemController::class);
Route::apiResource('reviews', ReviewController::class);
Route::apiResource('users', UserController::class);



/* Route::apiResource('books', BookController::class);


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'login']);

Route::Middleware(['auth:sanctum'])->group(function(){
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
});
 */

 
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
