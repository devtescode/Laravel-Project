<?php

namespace App\Http\Controllers\V1\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Location\UpdateDriverLocationRequest;
use App\Http\Requests\V1\Profile\UpdateDriverProfileRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Support\Utils;
use App\Models\Driver;

class DriverController extends Controller
{
    public function updateDriverProfile(UpdateDriverProfileRequest $request)
    {
        $user = $request->user();
        $driver = Driver::where('user_id', $user->id)->first();

        if (!$driver) {
            return Utils::errorResp('User not found');
        }

        $driver->update($request->validated());
        return Utils::successResp(['user' => $driver], 'User profile updated successfully');
    }

    public function updateDriverLocation(UpdateDriverLocationRequest $request)
    {
        try {
            $user = $request->user();
    
            $driver = Driver::where('user_id', $user->id)->first();
    
            if (!$driver) {
                return Utils::errorResp('Driver not found');
            }
    
            $driver->update([
                'current_lat' => $request->input('current_lat'),
                'current_lng' => $request->input('current_lng'),
            ]);
    
            return Utils::successResp(['user' => $driver], 'Driver location updated successfully');
        } catch (\Throwable $th) {
            return Utils::errorResp($th->getMessage());
        }
    }

    public function getAvailableDrivers()
    {
        $drivers = Driver::where('available', true)->get();

        return Utils::successResp(['user' => $drivers]);
    }

}
