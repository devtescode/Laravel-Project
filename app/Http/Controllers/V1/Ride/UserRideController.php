<?php

namespace App\Http\Controllers\V1\Ride;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Ride\CreateRideRequest;
use App\Models\Driver;
use App\Models\Ride;
use App\Support\Utils;
use Illuminate\Http\Request;

class UserRideController extends Controller
{
    public function createRide(CreateRideRequest $request)
    {
        try {
            $user = $request->user();
            $data = $request->validated();

            $distance = $request->calculateDistance();
            $data['fare'] = $request->calculateFare($distance);

            $data['user_id'] = $user->id;

            $inProgressRide = Ride::where('user_id', $user->id)->where('status', 'in_progress')->exists();
            $requestedRide = Ride::where('user_id', $user->id)->where('status', 'requested')->exists();
            
            if ($inProgressRide) {
                return Utils::errorResp('Please complete or cancel your current ride before requesting a new one.');
            }
            
            if ($requestedRide) {
                return Utils::errorResp('You already have a ride requested. Please wait for it to be accepted or cancel it.');
            }
            

            $ride = Ride::create($data);
            
            return Utils::successResp(['ride' => $ride], 'Ride requested successfully');
        } catch (\Throwable $th) {
            return Utils::errorResp($th->getMessage());
        }
    }


    protected function calculateDistance($lat1, $lng1, $lat2, $lng2)
    {
        $earthRadius = 6371; // Radius of the Earth in kilometers

        $lat1 = deg2rad($lat1);
        $lng1 = deg2rad($lng1);
        $lat2 = deg2rad($lat2);
        $lng2 = deg2rad($lng2);

        $latDelta = $lat2 - $lat1;
        $lngDelta = $lng2 - $lng1;

        $a = sin($latDelta / 2) * sin($latDelta / 2) +
            cos($lat1) * cos($lat2) *
            sin($lngDelta / 2) * sin($lngDelta / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c; // Distance in kilometers

        return $distance;
    }


    protected function calculateFare($distance)
    {
        $baseFare = 3.00; // Base fare in your currency
        $perKmRate = 1.50; // Rate per kilometer in your currency
        $fare = $baseFare + ($perKmRate * $distance);

        // Optionally, implement surge pricing or other modifiers
        // $fare *= $this->getSurgeMultiplier();

        return round($fare, 2); // Round to two decimal places
    }



    public function updateRideStatus(Request $request, $rideId)
    {
        try {
            $data = $request->validate([
                'status' => 'required|string|in:requested,accepted,completed,cancelled',
            ]);

            $ride = Ride::find($rideId);

            if (!$ride) {
                return Utils::errorResp('Ride not found');
            }

            $ride->update(['status' => $data['status']]);

            return Utils::successResp(['ride' => $ride], 'Ride status updated successfully');
        } catch (\Throwable $th) {
            return Utils::errorResp($th->getMessage());
        }
    }

    public function cancelRide($rideId)
    {
        try {
            $ride = Ride::find($rideId);

            if (!$ride) {
                return Utils::errorResp('Ride not found');
            }

            $ride->update(['status' => 'cancelled']);

            return Utils::successResp([], 'Ride cancelled successfully');
        } catch (\Throwable $th) {
            return Utils::errorResp($th->getMessage());
        }
    }

    public function rateRide(Request $request, $rideId)
    {
        try {
            $data = $request->validate([
                'rating' => 'required|integer|min:1|max:5',
                'comment' => 'nullable|string|max:500',
            ]);

            $ride = Ride::find($rideId);

            if (!$ride) {
                return Utils::errorResp('Ride not found');
            }

            // Assuming there's a `ratings` relation or similar setup
            $ride->rating()->create([
                'rating' => $data['rating'],
                'comment' => $data['comment'],
                'user_id' => $request->user()->id,
            ]);

            return Utils::successResp([], 'Ride rated successfully');
        } catch (\Throwable $th) {
            return Utils::errorResp($th->getMessage());
        }
    }

}
