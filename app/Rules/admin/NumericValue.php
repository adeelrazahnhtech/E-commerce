<?php

namespace App\Rules\admin;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NumericValue implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(!is_numeric($value)){
            $fail('The :attribute must be numeric.');
        }
    }
}
