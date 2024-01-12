<?php

use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProfileController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware(['auth:api'])->group(function () {
    Route::get('profile', [ProfileController::class, 'profile']);
    Route::post('logout', [AuthController::class, 'logout']);

    Route::get('categories', [CategoryController::class, 'index']);

    Route::post('articles/create', [ArticleController::class, 'create']);

    Route::get('articles', [ArticleController::class, 'index']);

    Route::get('articles/detail/{id}', [ArticleController::class, 'detail']);
});
