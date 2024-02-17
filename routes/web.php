<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});


// AUTH
Route::get('/auth', [AuthController::class, 'index'])->name('auth');
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);
Route::get('/contact', [UserController::class, 'contact']);
Route::post('/send-mail', [UserController::class, 'sendMail']);

// logout
Route::post('/logout', [AuthController::class, 'logout']);

//FOOD
Route::resource('food', FoodController::class);
Route::post('/food-search', [FoodController::class, 'search']);
Route::post('/food-comment/{id}', [FoodController::class, 'comment']);
Route::delete('/food-comment/{id}', [FoodController::class, 'deleteComment']);

//POST
Route::get('/post', [PostController::class, 'index'])->name('post');

//MIDDLEWARE
Route::group(['middleware' => 'isAdmin'], function () {
    // trash
    Route::get('/food-trash', [FoodController::class, 'trash'])->name('trash');
    Route::post('/food-trash/{id}', [FoodController::class, 'trashRestore']);
    Route::delete('/food-trash/{id}', [FoodController::class, 'trashDelete']);
    //end trash
    // Route::get('food/{food}/edit', [FoodController::class, 'edit'])->name('food.update');
    // Route::put('food/{food}', [FoodController::class, 'update'])->name('food.update');
    // Route::delete('food/{food}', [FoodController::class, 'destroy'])->name('food.destroy');
    Route::resource('user', UserController::class);
});


//FOOD
// Route::get('/food', [FoodController::class, 'index']);
// Route::get('/food/{id}', [FoodController::class, 'show']);
// Route::get('/food/{id}/edit', [FoodController::class, 'edit']);
// Route::put('/food/{id}', [FoodController::class, 'update']);
// Route::delete('/destroy/{id}', [FoodController::class, 'destroy']);
// Route::get('/food/create', [FoodController::class, 'create']);
// Route::post('/food', [FoodController::class, 'store']);