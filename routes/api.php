<?php

use App\Http\Controllers\V1\Auth\AuthController;
use Illuminate\Support\Facades\Route;


// Example API route
Route::group(['prefix' => 'v1'], function  () {
    Route::post('register', [AuthController::class, "register"]);
    Route::post('login', [AuthController::class, "login"]);
});