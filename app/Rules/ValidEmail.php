<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidEmail implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Kiểm tra email không chứa khoảng trắng
        if (preg_match('/\s/', $value)) {
            $fail('Email không được chứa khoảng trắng.');
        }

        // Kiểm tra email không có hai dấu chấm liên tiếp
        if (strpos($value, '..') !== false) {
            $fail('Email không được chứa hai dấu chấm liên tiếp.');
        }
    }
}
