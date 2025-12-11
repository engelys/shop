<?php

use Illuminate\Support\Facades\Route;

// route for tests DO NOT COMMIT CHANGES!
Route::get('/v1/test', App\Http\Controllers\Api\ApiTestController::class)->name('api_test');

Route::get('/', function () {
    return view('welcome');
});
