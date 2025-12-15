<?php

use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

// route for tests DO NOT COMMIT CHANGES!
Route::get('/v1/test', App\Http\Controllers\Api\ApiTestController::class)->name('api_test');

# main page
Route::get('/', [ShopController::class, 'index'])->name('shop.index');
# product page
Route::get('/product/{product:slug}', [ShopController::class, 'show'])->name('shop.products.show');
# categories list
Route::get('/shop/', [ShopController::class, 'categories'])->name('shop.categories.categories');
# category products
Route::get('/shop/categories/{category:slug}', [ShopController::class, 'category'])->name('shop.categories.category');