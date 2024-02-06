<?php

use App\Http\Controllers\Admin\TravelsController;
use App\Http\Controllers\Admin\TravelToursController;
use App\Http\Controllers\Auth\AuthController;
use App\Models\Tour;
use App\Models\Travel;
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

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
});

Route::prefix('admin')->middleware('auth:sanctum')->group(function () {

    Route::post('travels', [TravelsController::class, 'store'])->name('travels.store')->can('create', Travel::class);
    Route::put('travels/{travel}', [TravelsController::class, 'edit'])->name('travels.edit')->can('update,travel');

    Route::post('travels/{travel}/tours', [TravelToursController::class, 'store'])->name('travels.tours.store')->can('create', Tour::class);

});

Route::post('/search', [\App\Http\Controllers\Guest\TravelsController::class, 'search'])->name('search');
