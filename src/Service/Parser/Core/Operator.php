<?php

namespace App\Service\Parser\Core;

abstract class Operator implements OperatorInterface
{
    abstract public function isLeftAssociation();
    abstract public function getPrecidence();
}
