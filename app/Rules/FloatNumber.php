<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class FloatNumber implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $pattern = '/\d{2}\.\d{2}/';
        if (!preg_match($pattern, $value)) {
            $fail("The :attribute must be a xx.xx format.");
        }
        if ((float)$value>10){
            $fail("The :attribute must be less or equal to 10.");
        }
    }
}
