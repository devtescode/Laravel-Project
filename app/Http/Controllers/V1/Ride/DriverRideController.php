<?php

namespace App\Http\Controllers\V1\Ride;

use App\Http\Controllers\Controller;
use App\Models\Ride;
use App\Support\Utils;
use Illuminate\Http\Request;

class DriverRideController extends Controller
{
    public function getNewRequestedRides()
    {
        try {
            $requestedRides = Ride::where('status', 'requested')->get();

            return Utils::successResp(['data' => $requestedRides], 'Requested rides retrieved successfully');
        } catch (\Throwable $th) {
            return Utils::errorResp($th->getMessage());
        }
    }


    public function getRideDetails($rideId) {
        try {
            $ride = Ride::find($rideId);

            if (!$ride) {
                return Utils::errorResp('Ride not found');
            }

            return Utils::successResp(['ride' => $ride]);
        } catch (\Throwable $th) {
            return Utils::errorResp($th->getMessage());
        }
    }

    public function updateRide($rideId) {

    }

}
