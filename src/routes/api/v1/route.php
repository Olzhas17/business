<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Cart\AddCartProductController;
use App\Http\Controllers\Api\Cart\DeleteCartProductsController;
use App\Http\Controllers\Api\Cart\GetUserCartProductsController;
use App\Http\Controllers\Api\Product\ProductCreateController;
use App\Http\Controllers\Api\Product\ProductDeleteController;
use App\Http\Controllers\Api\Product\ProductDetailsController;
use App\Http\Controllers\Api\Product\ProductsGetController;
use App\Http\Controllers\Api\Product\ProductUpdateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('auth')->as('auth:')->group(function () {
    Route::post('/register', RegisterController::class)->name('register');
    Route::post('/login', LoginController::class)->name('login');
    Route::post('/logout', LogoutController::class)->name('logout')->middleware('auth:sanctum');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->prefix('products')->as('product:')->group(static  function() {
    Route::get('', ProductsGetController::class)->name('all');
    Route::post('', ProductCreateController::class)->name('create');
    Route::get('{id}', ProductDetailsController::class)->name('details');
    Route::put('{id}', ProductUpdateController::class)->name('update');
    Route::delete('{id}', ProductDeleteController::class)->name('delete');
});

Route::middleware('auth:sanctum')->prefix('carts')->as('cart:')->group(static function () {
    Route::post('', AddCartProductController::class);
    Route::get('', GetUserCartProductsController::class);
    Route::delete('', DeleteCartProductsController::class);
});
