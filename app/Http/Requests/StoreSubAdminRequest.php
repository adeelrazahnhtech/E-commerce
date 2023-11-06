<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubAdminRequest extends FormRequest
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
            'name' => 'required|min:3',
            'email' => 'required|email|max:255|unique:sub_admins',
            'password' => 'required|min:5|confirmed',
            'role'      => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field must be required',
            'email.required' => 'The email field must be required',
            'password.required' => 'The password field must be required',
            'role.required' => 'The role field must be required',
            ];
    }

    public function filters(): array
    {
        return [
            'name' => 'trim|capitalize|escape',
            'email' => 'trim|lowercase',
        ];
    }
}
