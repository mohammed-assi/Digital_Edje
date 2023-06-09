<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'FirstName' => 'nullable|string|max:255',
            'LastName' => 'nullable|string|max:255',
            'email' => 'nullable:phone|email|unique:users|max:255',
            'phone' =>  'nullable:email|numeric|min:10',
        ];
    }
}
