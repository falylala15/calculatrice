<?php

namespace App\Service\Parser\Core;

interface OperatorInterface
{
    public function process(int|float $firstNumber,int|float $secondNumber);
}
