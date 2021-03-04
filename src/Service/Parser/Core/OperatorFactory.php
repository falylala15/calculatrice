<?php

namespace App\Service\Parser\Core;

final class OperatorFactory
{
    public static function create(string $type)
    {
        return match($type) {
            '+' => new Adder(),
            '*' => new Multiplicator(),
            '-' => new Substractor(),
            '/' => new Dividator(),
            default => throw new \InvalidArgumentException("Unkown type"),
        };
    }
}
