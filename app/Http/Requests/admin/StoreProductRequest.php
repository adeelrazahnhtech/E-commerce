<?php

namespace App\Http\Requests\admin;

use App\Rules\admin\Lowercase;
use App\Rules\admin\MinCharacters;
use App\Rules\admin\NumericValue;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'title' => ['required','min:3'],
            'description' => ['required',new Lowercase],
            'price' => ['required',new NumericValue],
            'track_qty' => ['required',new NumericValue],
            'status'    => 'required',
            'category_id' => 'required',
        ];
    }
}
