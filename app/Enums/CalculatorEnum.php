<?php

namespace App\Enums;

enum CalculatorEnum: string
{
    case DIVIDE = '/';
    case MULTIPLY = '*';
    case SUBTRACTION = '-';
    case ADDITION = '+';

    public static function getOperators(): array
    {
        $array = [];
        foreach (self::cases() as $case) {
            $array[] = $case->value;
        }

        return $array;
    }

    public static function getEscapedOperatorsArray(): string
    {
        $escapedOperators = array_map(static function ($operator) {
            return '\\'.$operator;
        }, self::getOperators());

        return '['.implode('', $escapedOperators).']';
    }
}
