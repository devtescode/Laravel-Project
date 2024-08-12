<?php

namespace App\Http\Controllers\V1\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Profile\UpdateUserProfileRequest;
use App\Models\User;
use App\Models\Driver;
use App\Support\Utils;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Get User Profile
    public function getUserProfile($userId)
    {
        try {
            $user = User::find($userId);

            if (!$user) {
                return Utils::errorResp('User not found');
            }

            $profile = [];

            if ($user->user_type === 'driver') {
                $driver = Driver::where('user_id', $userId)->first();

                if ($driver) {
                    $profile = [
                        'vehicle_name' => $driver->vehicle_name,
                        'vehicle_color' => $driver->vehicle_color,
                        'license_plate' => $driver->license_plate,
                        'vehicle_type' => $driver->vehicle_type,
                        'current_lat' => $driver->current_lat,
                        'current_lng' => $driver->current_lng,
                        'available' => $driver->available,
                        'license_number' => $driver->license_number,
                        'profile_complete' => $driver->profile_complete,
                    ];
                }
            }

            $userData = $user->toArray();
            $userData['profile'] = $profile;

            return Utils::successResp(['user' => $userData], 'User profile retrieved successfully');
        } catch (\Throwable $th) {
            return Utils::errorResp($th->getMessage());
        }
    }


    // Update User Profile
    public function updateUserProfile(UpdateUserProfileRequest $request)
    {
        $user = $request->user();
        $data = User::find($user->id);

        if (!$data) {
            return Utils::successResp([], 'User not found');
        }

        $data->update($request->validated());
        return Utils::successResp(['user' => $data], 'User profile updated successfully');
    }

    // Delete User Account
    public function deleteUserAccount($userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return Utils::successResp([], 'User not found');
        }

        $user->delete();
        return Utils::successResp([], 'User account deleted successfully');
    }
}
