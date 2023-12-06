<?php

namespace App\Rules\admin;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MinCharacters implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    protected $minCharacters;

    public function __construct($minCharacters){
        $this->minCharacters = $minCharacters;

    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(!is_string($value) && mb_strlen($value) >= $this->minCharacters){
            $fail('The :attribute must be a minimum of {$this->minCharacters} characters');
        }
    }
}
