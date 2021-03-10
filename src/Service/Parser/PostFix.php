<?php

namespace App\Service\Parser;

use App\Service\Parser\Core\OperatorFactory;
use App\Service\Parser\Queue;
use App\Service\Parser\Stack;

class PostFix implements TermTransformerInterface
{
    public function convert(array $expressions) : array
    {
        $output = new Queue();
        $stack = new Stack();
        
        foreach ($expressions as $expression) {
            if (is_numeric($expression)) {
                $output->enqueue($expression);
            } elseif (in_array($expression, ExpressionUtils::BASIC_OPERATORS)) {
                $firstOperator = OperatorFactory::create($expression);
                while (!$stack->isEmpty() && in_array($stack->peek(), ExpressionUtils::BASIC_OPERATORS)) {
                    $secondOperator = OperatorFactory::create($stack->peek());
                    if (($firstOperator->isLeftAssociation()  && $firstOperator->getPrecidence() <= $secondOperator->getPrecidence()) || (!$firstOperator->isLeftAssociation() && $firstOperator->getPrecidence() < $secondOperator->getPrecidence())) {
                        $output->enqueue($stack->pop());
                    } else {
                        break;
                    }
                }
                
                $stack->push($expression);
            } elseif ($expression == ExpressionUtils::LEFT_PARENTHESIS) {
                $stack->push($expression);
            } elseif ($expression == ExpressionUtils::RIGHT_PARENTHESIS) {
                while ($stack->peek() != ExpressionUtils::LEFT_PARENTHESIS) {
                    $output->enqueue($stack->pop());
                }
             
                if ($stack->isEmpty()) {
                    throw new \Exception("Miss parenthese");
                }
                
                $stack->pop();
            }
        }
        
        while (!$stack->isEmpty()) {
            $output->enqueue($stack->pop());
        }
       
        return $output->getData();
    }
}
