<?php

namespace App\Http\Requests\auth;

use Illuminate\Foundation\Http\FormRequest;

class loginRequest extends FormRequest
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
            'email' => 'required_without:phone|email|max:255',
            'password' => 'required|min:5',
            'phone' =>  'required_without:email|numeric|min:10',
        ];
    }
}
