<?php

namespace App\Service\Parser\Core;

final class OperatorFactory
{
    const PLUS = '+';
    const MINUS = '-';
    const MULTIPLICATION = '*';
    const DIVIDE = '/';

    public static function create(string $type)
    {
        switch ($type) {
            case self::PLUS:
                    return new Adder();
                break;
            case self::MINUS:
                    return new Substractor;
                break;
            case self::MULTIPLICATION:
                    return new Multiplicator;
                break;
            case self::DIVIDE:
                    return new Dividator;
                break;
            default:
                    throw new \InvalidArgumentException("Unkown type");
                break;
        }
    }
}
