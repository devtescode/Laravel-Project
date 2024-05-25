<?php

namespace App\Http\Requests\V1\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'referred_by' => ['nullable', 'string']
        ];

        if ($this->has('referred_by')) {
            // $rules['referred_by'] = ['nullable', 'string', new ReferralCodeExists];
            // return User::where('referral_code', $value)->exists();
        }

        return $rules;
    }

    public function userAttributes()
    {
        $validated = $this->safe()
            ->except(['referral_code', 'confirmed']);

        $validated['password'] = Hash::make($validated['password']);

        if ($this->has('referred_by')) {
            $validated['referred_by'] = \trim(\strip_tags($this->input('referred_by')));
        }

        return collect($validated)
            ->merge(['referral_code' => strtoupper(bin2hex(random_bytes(5)))])
            ->toArray();
    }
}
