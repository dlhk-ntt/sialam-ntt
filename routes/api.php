<?php

use App\Http\Controllers\Api\AuthenticationController;
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

Route::middleware(['auth:api', 'scope:profile'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Api', 'prefix' => 'v1'], function () {
    Route::post('login', [AuthenticationController::class, 'authenticate']);
    Route::middleware(['auth:api', 'scope:profile'])->group(function () {
        Route::post('check', [AuthenticationController::class, 'chksess']);
        Route::post('logout', [AuthenticationController::class, 'destroy']);    
    });
});
