<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Auth\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;

class AuthController extends Controller
{
    public function register (RegisterRequest $request) {
        {
            try {
                $user = User::create($request->userAttributes());
                $token = $user->createToken('authToken')->plainTextToken;
                
                // $validate = Validator::make($request->all(), [
                //     "first_name" => "required",
                //     "last_name" => "required",
                //     "email" => "required|email",
                //     "password" => "required|min:6",
                //     "confirm_password" => "required|same:password",
                // ], [
                //     "confirm_password" => "The confirm password must match the password field."
                // ]);
                // if ($validate->fails()) {
                //     $data = [
                //         "status" => "false",
                //         "message" => "Validation failed",
                //         "errors" => $validate->messages(),
                //     ];
                //     return response()->json($data, 422);
                // } else {
                //     $credentials = $request->only("email", "password");
                //     $credentials["password"] = bcrypt($credentials["password"]);
                //     $user = User::create($credentials);
                //     // Add any additional logic here, e.g., sending confirmation email, logging in the user, etc.
                //     $data = [
                //         "status" => "success",
                //         "message" => "User registered successfully.",
                //         "user" => $user,
                //     ];
                //     return response()->json($data, 201);
                // }
    
            } catch (\Throwable $th) {
                $data = [
                    "status" => "error",
                    "message" => "An error occurred while registering the user.",
                    "error" => $th->getMessage(),
                ];
                return response()->json($data, 500);
            }
        }
    
            // $user = User::get();
            // return $user;

    }
    public function login (Request $request) {
        // return response()->json(['message' => 'This is an example API endpoint']);
        // $this->validate($request, [ 
        //     "email"=> "",
        //     "password"=> "",
        //     ]);
        //     $user = auth()->user();
        //     $user->email = $request->email;
        //     $user->password = bcrypt($request->password);
        //     $user->save();
        //     return back()->with("success","");

    }
}
