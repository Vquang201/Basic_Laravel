<?php

use App\Http\Controllers\api\ApiFoodController;
use App\Http\Controllers\api\AuthController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::apiResource('food', ApiFoodController::class);
Route::apiResource('auth', AuthController::class);
Route::post('auth/login', [AuthController::class, 'storeLogin']);
Route::post('auth/register', [AuthController::class, 'storeRegister']);
