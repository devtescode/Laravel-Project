<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Auth\PasswordResetRequest;
use App\Mail\ResetPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;

use App\Support\Utils;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PasswordController extends Controller
{
    public function resetCode(PasswordResetRequest $request)
    {
        try {
            // $code = mt_rand(111111, 999999);
            $code = $this->generateRandomToken(6);
            $user = User::whereEmail($request->email)->first();

            
            DB::table('password_resets')
                ->whereEmail($request->email)
                ->delete();
            
            DB::table('password_resets')
                ->insert($request->tokensAttr($code));
            
            Mail::to($request->email)->send(new ResetPasswordMail($user, $code));
            
            return Utils::successResp();
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => "error occured",
                'data' => $e->getMessage()
            ], 409);
            // return Utils::errorResp();
        }
    }

    function generateRandomToken($length, $email="") {
        $characters = 'abcdef0123456789';
        $token = '';

        for ($i = 0; $i < $length; $i++) {
            $randomIndex = rand(0, strlen($characters) - 1);
            $token .= $characters[$randomIndex];
        }

        return $token;
    }
}
