<?php

namespace App\Http\Requests\V1\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'phone' => ['required', 'numeric', 'digits_between:10,15', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'referred_by' => ['nullable', 'string'],
            'user_type' => ['required', 'string', 'in:user,admin,driver']
        ];

        if ($this->input('user_type') === 'driver') {
            $rules = array_merge($rules, [
                'vehicle_name' => ['nullable', 'string', 'max:255'],
                'vehicle_color' => ['nullable', 'string', 'max:50'],
                'license_plate' => ['nullable', 'string', 'max:50', 'unique:drivers'],
                'vehicle_type' => ['nullable', 'string', 'max:50'],
                'current_lat' => ['nullable', 'numeric'],
                'current_lng' => ['nullable', 'numeric'],
                'available' => ['nullable', 'boolean'],
                'license_number' => ['nullable', 'string', 'max:50'],
                'profile_complete' => ['nullable', 'boolean'],
            ]);
        }

        return $rules;
    }
    /**
     * Extract user attributes from validated data.
     */
    public function userAttributes()
    {
        $validated = $this->safe()->except(['referral_code', 'confirmed']);
        $validated['password'] = Hash::make($validated['password']);

        if ($this->has('referred_by')) {
            $validated['referred_by'] = \trim(\strip_tags($this->input('referred_by')));
        }

        if ($validated['user_type'] === 'driver') {
            $validated['profile_complete'] = false;
        }

        return collect($validated)
            ->merge(['referral_code' => strtoupper(bin2hex(random_bytes(5)))])
            ->toArray();
    }
}
