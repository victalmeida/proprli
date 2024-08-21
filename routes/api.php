<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskStatusController;
use App\Http\Controllers\TaskCommentController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/**
 * Auth Routes
 */
Route::prefix('/auth')->group(function () {
    Route::post('/', [AuthController::class, 'authenticate']);
    Route::middleware('auth:api')->group(function () {
        Route::get('/me', [AuthController::class, 'me']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::put('/', [AuthController::class, 'refresh']);
    });
});


/**
 * Task Routes
 */
Route::middleware('auth:api')->prefix('/task')->group(function () {
    Route::post('/', [TaskController::class, 'create']);
    Route::put('/', [TaskController::class, 'update']);
    Route::get('/', [TaskController::class, 'index']);
});

/**
 * Task Status Routes
 */
Route::middleware('auth:api')->prefix('/task/status')->group(function () {
    Route::get('/', [TaskStatusController::class, 'index']);
});

/**
 * Task Status Routes
 */
Route::middleware('auth:api')->prefix('/task/comment')->group(function () {
    Route::post('/', [TaskCommentController::class, 'create']);
});
