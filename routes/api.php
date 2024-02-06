<?php

use App\Http\Controllers\Admin\TravelsController;
use App\Http\Controllers\Admin\TravelToursController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
});

Route::prefix('admin')->group(function () {
    Route::apiResource('travels', TravelsController::class)->only(['store', 'edit']);
    Route::apiResource('travels.tours', TravelToursController::class)->only(['store']);
});

Route::post('/search', 'App\Http\Controllers\Guest\TravelsController@search')->name('search');
