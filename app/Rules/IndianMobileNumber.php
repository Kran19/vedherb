<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class IndianMobileNumber implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // 1. Check if numeric
        if (!is_numeric($value)) {
            $fail('The :attribute must be a number.');
            return;
        }

        // 2. Check length (Must be exactly 10 digits)
        if (strlen($value) !== 10) {
            $fail('The :attribute must be exactly 10 digits.');
            return;
        }

        // 3. Indian Mobile Regex: Starts with 6-9, followed by 9 digits
        if (!preg_match('/^[6-9]\d{9}$/', $value)) {
            $fail('The :attribute must be a valid Indian mobile number starting with 6, 7, 8, or 9.');
            return;
        }

        // 4. Check for repeating digits validation (e.g., 9999999999)
        if (preg_match('/^(\d)\1{9}$/', $value)) {
            $fail('The :attribute cannot consist of a single repeating digit.');
            return;
        }
    }
}
