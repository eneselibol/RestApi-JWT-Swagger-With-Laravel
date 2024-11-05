<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->controller(ItemController::class)->group(function () {
    Route::get('/items', 'index');
    Route::post('/item', 'store');
    Route::get('/item/{id}', 'show');
    Route::put('/item', 'update');
    Route::delete('/item/{id}', 'destroy');
});


Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
});
