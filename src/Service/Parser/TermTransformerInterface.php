<?php

namespace App\Service\Parser;

interface TermTransformerInterface
{
    public function convert(array $terms) : array;
}
