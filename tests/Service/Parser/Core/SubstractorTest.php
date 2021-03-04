<?php

use App\Service\Parser\Core\Adder;
use App\Service\Parser\Core\Substractor;
use PHPUnit\Framework\TestCase;

class SubstractorTest extends TestCase
{
    protected function setUp(): void
    {
        $this->adder = new Substractor;
    }

    /**
     * @dataProvider adderProvider
     */
    public function testProcess($a, $b, $expected)
    {
        $this->assertSame($expected, $this->adder->process($a, $b));
    }

    public function testIsLeftAssociation()
    {
        $this->assertTrue($this->adder->isLeftAssociation());
    }

    public function testgetPrecidence()
    {
        $this->assertEquals(2, $this->adder->getPrecidence());
    }

    public function adderProvider()
    {
        return [
            [0, 0, 0],
            [0, 1, -1],
            [25, 5, 20],
            [100, 85, 15]
        ];
    }
}
