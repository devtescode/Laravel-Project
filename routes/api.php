<?php

use App\Http\Controllers\V1\Auth\AuthController;
use App\Http\Controllers\V1\Auth\PasswordController;
use App\Http\Controllers\V1\Profile\DriverController;
use App\Http\Controllers\V1\Profile\UserController;
use App\Http\Controllers\V1\Ride\UserRideController;
use App\Http\Controllers\V1\Ride\DriverRideController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'v1', 'middleware' => 'auth:sanctum'], function () {
    Route::post('logout', [AuthController::class, "logout"]);
});


Route::group(['prefix' => 'v1'], function () {
    Route::post('register', [AuthController::class, "register"]);
    Route::post('login', [AuthController::class, "login"]);

    Route::post('password/reset-code', [PasswordController::class, 'resetCode']);
    Route::post('password/check-code', [AuthController::class, 'CheckResetCode']);
    Route::post('password/reset', [AuthController::class, 'resetPassword']);

    
});

Route::group(['prefix' => 'v1', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/user/{userId}', [UserController::class, 'getUserProfile']);
    Route::put('/user/updateProfile', [UserController::class, 'updateUserProfile']);
    Route::delete('/user/{userId}', [UserController::class, 'deleteUserAccount']);

    Route::patch('/driver/updateProfile', [DriverController::class, 'updateDriverProfile']);
    Route::patch('/driver/updateLocation', [DriverController::class, 'updateDriverLocation']);
    Route::get('/driver/available', [DriverController::class, 'getAvailableDrivers']);

    Route::post('/user/createRide', [UserRideController::class, 'createRide']);
    Route::get('/driver/getNewRide', [DriverRideController::class, 'getNewRequestedRides']);
    Route::get('/driver/getRideDetails/{rideId}', [DriverRideController::class, 'getRideDetails']);
});


Route::any('{any}', function () {
    return response()->json([
        'status' => false,
        'message' => 'Route not found',
    ], 404);
})->where('any', '.*');