<?php

namespace App\Tests\Service\Parser;

use App\Service\Parser\ExpressionUtils;
use PHPUnit\Framework\TestCase;

class ExpressionUtilsTest extends TestCase
{
    /**
     * @dataProvider operationProvider
     */
    public function testSplitExpression($expected, $input): void
    {
        $expressionUtils = new ExpressionUtils();
        $result = $expressionUtils->split($input);
        
        $this->assertEquals($expected, $result);
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
