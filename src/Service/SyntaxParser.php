<?php

namespace App\Service;

use App\Service\Parser\Core\OperatorFactory;
use App\Service\Parser\Queue;
use App\Service\Parser\Stack;

class SyntaxParser
{
    const BASIC_OPERATORS = ['+','-', '*', '/'];
    const LEFT_PARENTHESIS = '(';
    const RIGHT_PARENTHESIS = ')';

    public function parse(string $words): array
    {
        $words = $this->tranform($words);
        $queue = $this->postfix($words);

        return $this->evaluate($queue);
    }

    private function evaluate(Queue $queue) : array
    {
        $tokens = $queue->getData();
        $output = new Stack();

        foreach ($tokens as $token) {
            if (in_array($token, self::BASIC_OPERATORS)) {
                $second = $output->pop();
                $first = $output->pop();
                $operator = OperatorFactory::create($token);
                $result = $operator->process($first, $second);

                $output->push($result);
            } else {
                $output->push($token);
            }
        }

        return ['result' => $output->pop()];
    }

    private function tranform(string $words) : array
    {
        $pattern = implode('', self::BASIC_OPERATORS); # standard mathematical operators
        $pattern = sprintf('@([%s])@', preg_quote($pattern)); # an escaped/quoted pattern
        $words = preg_split($pattern, preg_replace('@\s@', '', $words), -1, PREG_SPLIT_DELIM_CAPTURE);

        return $words;
    }

    private function postfix(array $words) : Queue
    {
        $output = new Queue();
        $stack = new Stack();
        
        foreach ($words as $word) {
            if (is_numeric($word)) {
                $output->enqueue($word);
            } elseif (in_array($word, self::BASIC_OPERATORS)) {
                $firstOperator = $secondOperator = OperatorFactory::create($word);
                while (!$stack->isEmpty()) {
                    $secondOperator = OperatorFactory::create($stack->peek());
                    if (($firstOperator->isLeftAssociation()  && $firstOperator->getPrecidence() <= $secondOperator->getPrecidence()) || (!$firstOperator->isLeftAssociation() && $firstOperator->getPrecidence() < $secondOperator->getPrecidence())) {
                        $output->enqueue($stack->pop());
                    } else {
                        break;
                    }
                }
                
                $stack->push($word);
            } elseif ($word == self::LEFT_PARENTHESIS) {
                $stack->push($word);
            } elseif ($word == self::RIGHT_PARENTHESIS) {
                while ($stack->peek() != self::LEFT_PARENTHESIS) {
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

        return $output;
    }
}
