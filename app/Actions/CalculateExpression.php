<?php

namespace App\Actions;

use InvalidArgumentException;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Symfony\Component\ExpressionLanguage\SyntaxError;

class CalculateExpression
{
    public function handle(string $expression): ?float
    {
        $expression = preg_replace('/[^\d.+\-*\/()]/i', '', $expression);

        // Evaluate the expression using Symfony Expression Language
        $language = new ExpressionLanguage();
        try {
            $result = $language->evaluate($expression);
        } catch (SyntaxError $e) {
            throw new InvalidArgumentException('Invalid expression');
        }

        return (float) $result;
    }
}
