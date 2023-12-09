<?php

namespace App\Http\Requests;

use Elegant\Sanitizer\Laravel\SanitizesInput;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreSellerRequest extends FormRequest
{
    use SanitizesInput;
    public function filters()
    {

        return [
            'name' => 'trim|escape|lowercase',
            'email' => 'trim|lowercase',
        ];
    }
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
        // if(\Request::isMethod('get')){
        //     return [
        //         'name' => 'required|min:3',
        //         'email' => 'required|email|max:255|unique:users',
        //         'password' => ['required','confirmed',Password::min(5)],
        //         'role'      => 'required',
        //     ];
        // }elseif (\Request::isMethod('put')) {
        //     return [
        //         'name' => 'required|min:3',
        //         'image' => 'required|mimes:png,jpg,jpeg,png|min:1024|max:10240',
        //     ];
        // }

        return [
            'name' => 'required|min:3',
            'email' => 'required|email|max:255|unique:users',
            'password' => ['required','confirmed',Password::min(5)],
            'role'      => 'required',
        ];
    }


    public function messages(): array
    {
        return [
            'name.required' => 'The name field must be necessary',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'username'
        ];
    }

}
