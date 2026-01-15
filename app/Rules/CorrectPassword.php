<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CorrectPassword implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $numbers = '0123456789';
        $specials = '_#!%';

        $upper = false;
        $lower = false;
        $number = false;
        $special = false;
        for ($i=0; $i < strlen($value); $i++) {
            if (mb_strtoupper($value[$i]) == $value[$i] && !$upper) {
                $upper = true;
            }
            if (mb_strtolower($value[$i]) == $value[$i] && !$lower) {
                $lower = true;
            }
            if (str_contains($numbers, $value[$i]) && !$number) {
                $number = true;
            }
            if (str_contains($specials, $value[$i]) && !$special) {
                $special = true;
            }
        }
        if (!$upper) {
            $fail('Password must have at least one uppercase letter');
        }
        if (!$lower) {
            $fail('Password must have at least one lowercase letter');
        }
        if (!$number) {
            $fail('Password must have at least one number');
        }
        if (!$special) {
            $fail("Password must have at least one special character ($specials)");
        }
    }
}
