<?php

use App\Http\Controllers\V1\Auth\AuthController;
use Illuminate\Support\Facades\Route;
// use Illuminate\Http\Request;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Example API route
Route::group(['prefix' => 'v1'], function  () {
    Route::get('/register', [AuthController::class, "register"]);
});
