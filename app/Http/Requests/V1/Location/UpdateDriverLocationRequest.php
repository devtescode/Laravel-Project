<?php

namespace App\Http\Requests\V1\Location;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDriverLocationRequest extends FormRequest
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
            'current_lat' => ['required', 'numeric','min:-90','max:90'],
            'current_lng' => ['required', 'numeric','min:-180','max:180'],
        ];
    }
}
