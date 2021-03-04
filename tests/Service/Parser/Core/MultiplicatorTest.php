<?php

use App\Service\Parser\Core\Multiplicator;
use PHPUnit\Framework\TestCase;

class MultiplicatorTest extends TestCase
{
    protected function setUp(): void
    {
        $this->multiplicator = new Multiplicator;
    }

    /**
     * @dataProvider multiplicatorProvider
     */
    public function testProcess($a, $b, $expected)
    {
        $this->assertSame($expected, $this->multiplicator->process($a, $b));
    }

    public function testIsLeftAssociation()
    {
        $this->assertTrue($this->multiplicator->isLeftAssociation());
    }

    public function testgetPrecidence()
    {
        $this->assertEquals(3, $this->multiplicator->getPrecidence());
    }

    public function multiplicatorProvider()
    {
        return [
            [0, 0, 0],
            [10, 10, 100],
            [15, 2, 30],
            [25, 2, 50],
            [85, 6, 510]
        ];
    }
}
