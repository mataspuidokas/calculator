<?php

namespace App\Rules;

use App\Enums\CalculatorEnum;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class DivisionByZeroRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->checkIfDivisionByZeroExists($value)) {
            $fail('In :attribute found division by zero, which is not allowed.');
        }
    }

    public function checkIfDivisionByZeroExists(string $expression): bool
    {
        $operators = implode('', array_map(function ($operator) {
            return '\\'.$operator;
        }, CalculatorEnum::getOperators()));

        $pattern = "/[$operators\s]+/";

        $parts = preg_split($pattern, $expression, -1, PREG_SPLIT_NO_EMPTY);

        foreach ($parts as $part) {
            if (is_numeric($part) && $part != 0) {
                continue;
            } elseif ($part === '0') {
                return true;
            }
        }

        return false;
    }
}
