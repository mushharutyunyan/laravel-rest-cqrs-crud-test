<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:api'],function () {
    Route::group(['prefix' => 'v1'], function () {
        Route::group(['prefix' => 'posts'], function () {
            // Queries
            Route::get('/', [\App\Http\Controllers\Api\V1\Posts\QueryController::class,'index']);
            Route::get('/{id}', [\App\Http\Controllers\Api\V1\Posts\QueryController::class,'show'])->middleware(['post.exists']);

            // Commands
            Route::post('/', [\App\Http\Controllers\Api\V1\Posts\CommandController::class,'store']);
            Route::patch('/{id}', [\App\Http\Controllers\Api\V1\Posts\CommandController::class,'update'])->middleware(['post.exists']);
            Route::delete('/{id}', [\App\Http\Controllers\Api\V1\Posts\CommandController::class,'delete'])->middleware(['post.exists']);
        });
    });
});
