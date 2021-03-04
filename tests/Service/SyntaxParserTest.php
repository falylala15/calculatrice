<?php

namespace App\Tests\Service;

use App\Service\SyntaxParser;
use PHPUnit\Framework\TestCase;

class SyntaxParserTest extends TestCase
{
    /**
     * @dataProvider operationProvider
     */
    public function testTransform($expected, $input): void
    {
        $syntaxParser = new SyntaxParser;
        $result = $this->invokeMethod($syntaxParser, 'tranform', [$input]);

        $this->assertEquals($expected, $result);
    }

    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);
    
        return $method->invokeArgs($object, $parameters);
    }

    public function operationProvider()
    {
        return [
            [['45', '/', '2','-', '3'], '45/2-3'],
            [['78', '*', '8', '-', '3'], '78*8-3'],
            [['18', '+','485', '/', '3'], '18+485/3'],
        ];
    }
}
