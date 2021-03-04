<?php

namespace App\Tests\Service\Parse;

use App\Service\Parser\Stack;
use PHPUnit\Framework\TestCase;

class StackTest extends TestCase
{
    protected function setUp(): void
    {
        $this->stack = new Stack;
    }

    public function testEmpty(): void
    {
        $this->assertTrue($this->stack->isEmpty());
    }

    /**
     * @depends testEmpty
     */
    public function testPushAndPeekAndPop() : void
    {
        $this->stack->push('foo');
        $this->stack->push('bar');
        $property = $this->getProtectedProprety($this->stack::class, 'data');
        $data = $property->getValue($this->stack);

        $this->assertSame('bar', $data[count($data)-1]);

        $end = $this->stack->peek();
        $this->assertSame('bar', $end);

        $this->stack->pop();
        $property = $this->getProtectedProprety($this->stack::class, 'data');
        $data = $property->getValue($this->stack);

        $this->assertSame('foo', $data[0]);
        $this->assertSame(1, count($data));
    }

    public function getProtectedProprety($className, $propertyName)
    {
        $reflector = new \ReflectionClass($className);
        $property = $reflector->getProperty($propertyName);
        $property->setAccessible(true);

        return $property;
    }
}
