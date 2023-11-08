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
    Route::apiResource('categories', CategoriesController::class)->except(['index', 'show'])->middleware('role:admin');
    Route::get('categories', [CategoriesController::class ,'index']);
    Route::get('categories/{category}', [CategoriesController::class ,'show']);
    Route::post('categories/restore/{id}', [CategoriesController::class ,'restore'])->middleware('role:admin');

    // partitions routes
    Route::apiResource('partitions', PartitionsController::class)->except(['index', 'show'])->middleware('role:admin');
    Route::get('partitions', [PartitionsController::class ,'index']);
    Route::get('partitions/{partition}', [PartitionsController::class ,'show']);
    Route::post('partitions/restore/{id}', [PartitionsController::class ,'restore'])->middleware('role:admin');

    // Items routes
    Route::apiResource('items', ItemsController::class)->except(['index', 'show'])->middleware('role:admin');
    Route::get('items', [ItemsController::class ,'index']);
    Route::get('items/{item}', [ItemsController::class ,'show']);
    Route::post('items/restore/{id}', [ItemsController::class ,'restore'])->middleware('role:admin');

});
