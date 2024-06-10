<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        try {
            $validatedData = $request->validated();
            // Extract user attributes from the validated request
            // $userAttributes = $request->userAttributes();
            
            // Create the user
            // $user = User::create($userAttributes);
            
            // Generate the authentication token
            // $token = $user->createToken('authToken')->plainTextToken;
    
            // Prepare the success response data
            // $validatedData = $request->validated();
            $data = [
                // "token" => $token,
                "user" => $validatedData,
                "status" => true,
                "message" => "User registered successfully"
            ];
    
            return response()->json($data, 201); // Use 201 Created status code
        } catch (\Throwable $th) {
            $data = [
                "status" => "error",
                "message" => "An error occurred while registering the user.",
                "error" => $th->getMessage(),
            ];
            return response()->json($data, 500);
        }
    }

    public function login(Request $request)
    {
        return response()->json(['message' => 'This is an example API login']);
    }
}
