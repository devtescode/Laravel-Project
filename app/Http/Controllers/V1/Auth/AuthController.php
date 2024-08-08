<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Auth\LoginRequest;
use App\Http\Requests\V1\Auth\RegisterRequest;
use App\Models\User;
use App\Support\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        try {
            $userAttributes = $request->userAttributes();
            $user = User::create($userAttributes);

            $token = $user->createToken('authToken')->plainTextToken;
            return Utils::successResp(['token' => $token, 'user' => $user]);

        } catch (\Throwable $th) {
            return Utils::errorResp($th->getMessage());
        }
    }

    public function login(LoginRequest $request)
    {
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
        $request->user()->token()->delete();

        return Utils::successResp([], 'Successfully logged out');
    }

    public function user(Request $request)
    {
        // if ($request->user()) {
        return Utils::successResp([
            'user' => $request->user(),
        ]);
        // }

        // return Utils::errorResp('Unauthorized', 401);
        // return Utils::errorResp('Unauthorized', 401);
    }
}
