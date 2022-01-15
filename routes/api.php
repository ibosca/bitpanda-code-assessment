<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Src\User\Infrastructure\Controller\UserGetController;
use Src\User\Infrastructure\Controller\UserPostController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', UserGetController::class);
Route::post('/users/{userId}', UserPostController::class);
