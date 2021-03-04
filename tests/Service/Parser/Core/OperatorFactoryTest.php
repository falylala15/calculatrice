<?php

use App\Service\Parser\Core\Adder;
use App\Service\Parser\Core\Dividator;
use App\Service\Parser\Core\Multiplicator;
use App\Service\Parser\Core\OperatorFactory;
use App\Service\Parser\Core\Substractor;
use PHPUnit\Framework\TestCase;

class OperatorFactoryTest extends TestCase
{
    /**
     * @dataProvider createFactoryProvider
     */
    public function testCreateOperator($a, $b)
    {
        $this->assertInstanceOf($a, $b);
    }
    public function testInvalidOperator()
    {
        $this->expectException(InvalidArgumentException::class);
        OperatorFactory::create('unkown');
    }

    public function createFactoryProvider()
    {
        return [
            [Adder::class,  OperatorFactory::create('+')],
            [Substractor::class,  OperatorFactory::create('-')],
            [Multiplicator::class,  OperatorFactory::create('*')],
            [Dividator::class,  OperatorFactory::create('/')]
        ];
    }
}
