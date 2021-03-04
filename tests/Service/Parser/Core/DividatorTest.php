<?php

use App\Service\Parser\Core\Dividator;
use PHPUnit\Framework\TestCase;

class DividatorTest extends TestCase
{
    protected function setUp(): void
    {
        $this->dividator = new Dividator;
    }

    /**
     * @dataProvider dividatorProvider
     */
    public function testProcess($a, $b, $expected)
    {
        $this->assertSame($expected, $this->dividator->process($a, $b));
    }

    public function testDivideByZero()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->dividator->process(10, 0);
    }

    public function testIsLeftAssociation()
    {
        $this->assertTrue($this->dividator->isLeftAssociation());
    }

    public function testgetPrecidence()
    {
        $this->assertEquals(3, $this->dividator->getPrecidence());
    }

    public function dividatorProvider()
    {
        return [
            [0, 1, 0],
            [10, 2, 5],
            [100, 5 , 20]
        ];
    }
}
