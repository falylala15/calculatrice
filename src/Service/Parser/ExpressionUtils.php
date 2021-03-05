<?php

namespace App\Service\Parser;

use App\Service\SyntaxParser;

class ExpressionUtils
{
    const BASIC_OPERATORS = ['+','-', '*', '/'];
    const LEFT_PARENTHESIS = '(';
    const RIGHT_PARENTHESIS = ')';

    public function split(string $words) : array
    {
        $pattern = implode('', array_merge(self::BASIC_OPERATORS, [self::LEFT_PARENTHESIS, self::RIGHT_PARENTHESIS]));
        $pattern = sprintf('@([%s])@', preg_quote($pattern));
        $words = preg_split($pattern, preg_replace('@\s@', '', $words), -1, PREG_SPLIT_DELIM_CAPTURE);
        $words = array_filter($words);

        return $words;
    }
}
