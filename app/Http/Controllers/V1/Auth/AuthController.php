<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Auth\LoginRequest;
use App\Http\Requests\V1\Auth\RegisterRequest;
use App\Models\Driver;
use App\Models\User;
use App\Support\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;



use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Events\Verified;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        try {
            $userAttributes = $request->userAttributes();
            $user = User::create($userAttributes);

            if ($user->user_type === 'driver') {
                $driverAttributes = $request->only([
                    'vehicle_name',
                    'vehicle_color',
                    'license_plate',
                    'vehicle_type',
                    'current_lat',
                    'current_lng',
                    'available' => false,
                    'license_number',
                    'profile_complete' => false,
                ]);

                Driver::create(array_merge([
                    'user_id' => $user->id
                ], $driverAttributes));
            }

            $token = $user->createToken('authToken')->plainTextToken;
            return Utils::successResp(['token' => $token, 'user' => $user]);

        } catch (\Throwable $th) {
            return Utils::errorResp($th->getMessage());
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            $req = $request->validated();
            $user = User::whereEmail($req['email'])->first();

            if (!$user || !Hash::check($req['password'], $user->password)) {
                return response()->json([
                    'message' => 'The password or user email is invalid.',
                    'errors' => [
                        'email' => ['The password or user email is invalid.']
                    ]
                ], 422);
            }

            return Utils::successResp([
                'token' => $user->createToken('authToken')->plainTextToken,
                'user' => $user,
            ]);
        } catch (\Throwable $th) {
            return Utils::errorResp($th->getMessage());
        }
    }

    // public function refreshToken(Request $request)
    // {
    //     $user = $request->user();

    //     return Utils::successResp([
    //         'token' => $user->createToken('authToken')->plainTextToken,
    //         'user' => $user,
    //     ]);
    // }

    /**
     * log user out
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();
        return Utils::successResp([], 'Successfully logged out');
    }
}

