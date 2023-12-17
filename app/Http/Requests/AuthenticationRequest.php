<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthenticationRequest extends FormRequest
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

        switch (request()->route()->getName()) {
            case 'login':
                return [
                    'email'=> 'required',
                    'password'=> 'required',
                ];

            case 'register':
                return [
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'annual_income' => 'required',
                    'email'=> 'required|unique:App\Models\User,email',
                    'phone_number' => 'required',
                    'password'=> 'required',
                ];

            default:
                break;
        }
    }
}
