<?php

namespace App\Http\Requests\V1\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfileRequest extends FormRequest
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
            'first_name' => ['sometimes', 'required', 'string', 'max:50'],
            'last_name' => ['sometimes', 'required', 'string', 'max:50'],
            'email' => ['sometimes', 'required', 'string', 'email', 'max:50', 'email', 'unique:users,email,' . $this->user()->id],
            'phone' => ['sometimes', 'required', 'numeric', 'digits_between:10,15', 'unique:users,phone,' . $this->user()->id],
        ];
    }
}
