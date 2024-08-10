<?php

namespace App\Http\Controllers\V1\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Profile\UpdateUserProfileRequest;
use App\Models\User;
use App\Support\Utils;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class UserController extends Controller
{
    // Get User Profile
    public function getUserProfile($userId)
    {
        try {
            $user = User::find($userId);
    
            if (!$user) {
                return Utils::successResp([], 'User not found');
            }

            return Utils::successResp(['user' => $user]);
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
