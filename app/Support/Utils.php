<?php

namespace App\Support;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use App\Models\AppSetting;

class Utils
{
    /**
     * Json success response helper without extra headers
     * and body
     *
     * @param  mixed  $message
     * @param  mixed  $data
     * @return \Illuminate\Http\JsonResponse
     */
    public static function successResp($data = [], $message = 'successful')
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], 200);
    }

    /**
     * Json post request response helper
     *
     * @param  mixed  $message
     * @param  mixed  $data
     * @return \Illuminate\Http\JsonResponse
     */
    public static function postResp($data = [], $message = 'success')
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ]);
    }

    /**
     * Json post request response helper
     *
     * @param  mixed  $message
     * @param  mixed  $data
     * @return \Illuminate\Http\JsonResponse
     */
    public static function errorResp($message = 'Error occured while processing your request', $code = 409)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $code);
    }

    /**
     * Throw validation with json repoonse
     *
     * @param  mixed  $errors
     * @return \Illuminate\Http\JsonResponse
     */
    public static function validateResp($errors = [])
    {
        throw ValidationException::withMessages($errors);
    }
    
}
