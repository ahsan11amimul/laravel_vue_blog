<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PostController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login',[AuthController::class,'login']);
Route::post('/register',[AuthController::class,'register']);
Route::get('/posts',[PostController::class,'index']);
Route::get('/post/{id}/category', [PostController::class, 'post_category']); 
Route::get('/post/{post}',[PostController::class,'show']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout',[AuthController::class,'logout']);
    Route::post('/post',[PostController::class,'store']);
    Route::post('/post/{post}',[PostController::class,'update']);
    Route::DELETE('/post/{post}',[PostController::class,'destroy']);
});