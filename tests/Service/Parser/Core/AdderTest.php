<?php

use App\Service\Parser\Core\Adder;
use PHPUnit\Framework\TestCase;

class AdderTest extends TestCase
{
    protected function setUp(): void
    {
        $this->adder = new Adder;
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
            [0, 1, 1],
            [1, 0, 1],
            [1, 1, 2]
        ];
    }
}
