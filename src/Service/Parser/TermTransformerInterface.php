<?php

namespace App\Service\Parser;

interface TermTransformerInterface
{
    public function transform(array $terms) : array;
}
