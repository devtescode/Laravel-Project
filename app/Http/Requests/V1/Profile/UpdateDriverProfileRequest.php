<?php

namespace App\Http\Requests\V1\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDriverProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'vehicle_name' => ['sometimes', 'required', 'string', 'max:255'],
            'vehicle_color' => ['sometimes', 'required', 'string', 'max:50'],
            'license_plate' => ['sometimes', 'required', 'string', 'max:50', 'unique:drivers'],
            'vehicle_type' => ['sometimes', 'required', 'string', 'max:50'],
            'current_lat' => ['sometimes', 'required', 'numeric'],
            'current_lng' => ['sometimes', 'required', 'numeric'],
            'available' => ['sometimes', 'required', 'boolean'],
            'license_number' => ['sometimes', 'required', 'string', 'max:50'],
            'profile_complete' => ['sometimes', 'required', 'boolean'],
        ];
    }
}
