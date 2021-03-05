<?php

namespace App\Tests\Service\Parser;

use App\Service\Parser\ExpressionUtils;
use App\Service\Parser\PostFix;
use App\Service\Parser\TermTransformerInterface;
use App\Service\SyntaxParser;
use PHPUnit\Framework\TestCase;

class SyntaxParserTest extends TestCase
{

    /**
     * @dataProvider evalProvider
     */
    public function testEval($input, $expected)
    {
        $termTransformerMock =  $this->createMock(TermTransformerInterface::class);
        $expressionUtilsMock = $this->createMock(ExpressionUtils::class);
        $syntaxParser = new SyntaxParser($termTransformerMock, $expressionUtilsMock);
        $result = $this->invokeMethod($syntaxParser, 'eval', $input);

        $this->assertSame($expected, $result);
    }

    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);
    
        return $method->invokeArgs($object, $parameters);
    }

    public function evalProvider()
    {
        return [
             [[['2', '6', '+','3', '2','*', '-']] ,  ['result' => 2] ],
             [[['25', '2', '/','3', '-']] ,  ['result' => 9.5] ]
        ];
    }
}
