<?php

namespace App\Service\Parser\Core;

class Dividator extends Operator
{
    public function process(int|float $number,int|float $divisor)
    {
        if ($divisor == 0) {
            throw new \InvalidArgumentException("On ne peut pas faire une division par 0");
        }

        return $number / $divisor;
    }

    public function isLeftAssociation(): bool
    {
        return true;
    }

    public function getPrecidence() : int
    {
        return 3;
    }
}
