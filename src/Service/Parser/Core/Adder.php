<?php

namespace App\Service\Parser\Core;

class Adder extends Operator
{
    public function process(int|float $firstNumber,int|float $secondNumber)
    {
        return $firstNumber + $secondNumber;
    }

    public function isLeftAssociation() : bool
    {
        return true;
    }

    public function getPrecidence() : int
    {
        return 2;
    }
}
