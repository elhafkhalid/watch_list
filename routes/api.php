<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\MovieController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
});


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/movies',[MovieController::class,'store']);
    Route::get('/movies',[MovieController::class,'index']);
    Route::get('/movies/{id}',[MovieController::class,'show']);
    Route::put('/movies/{id}',[MovieController::class,'update']);
    Route::delete('/movies/{id}',[MovieController::class,'destroy']);
});