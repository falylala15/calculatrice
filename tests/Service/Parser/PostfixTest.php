<?php

namespace App\Tests\Service\Parser;

use App\Service\Parser\PostFix;
use PHPUnit\Framework\TestCase;

class PostFixTest extends TestCase
{
    /**
     * @dataProvider operationProvider
     */    
   public function testTermsToPostix($expected, $input)
   {
        $postix = new PostFix();
        $result = $postix->convert($input);

        $this->assertSame($expected, $result);
   }

   public function operationProvider()
    {
        return [
            [['2', '6', '+','3', '2','*', '-'], ['2','+','6','-','3','*','2']],
            [['20', '6', '/','3', '2','*', '-'], ['20','/','6','-','3','*','2']],
        ];
    }
}
