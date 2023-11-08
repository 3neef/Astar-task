<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\ItemsController;
use App\Http\Controllers\Api\PartitionsController;
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

Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/register', [AuthController::class, 'register'])->middleware('role:admin');
    // categories routes
    Route::apiResource('categories', CategoriesController::class);
    Route::post('categories/restore/{id}', [CategoriesController::class ,'restore']);

    // partitions routes
    Route::apiResource('partitions', PartitionsController::class);
    Route::post('partitions/restore/{id}', [PartitionsController::class ,'restore']);

    // Items routes
    Route::apiResource('items', ItemsController::class);
    Route::post('items/restore/{id}', [ItemsController::class ,'restore']);

});
