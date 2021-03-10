<?php

namespace App\Service;

use App\Service\Parser\Core\OperatorFactory;
use App\Service\Parser\ExpressionUtils;
use App\Service\Parser\Stack;
use App\Service\Parser\TermTransformerInterface;

class SyntaxParser
{
    public function __construct(
        private TermTransformerInterface $termTransformer,
        private ExpressionUtils $expressionUtils 
        ) {}

    public function parse(string $terms): array
    {
        $terms = $this->expressionUtils->split($terms);   
        $terms = $this->termTransformer->convert($terms);
        
        return $this->eval($terms);
    }

    private function eval(array $terms) : array
    {
        $output = new Stack();
        foreach ($terms as $term) {
            if (in_array($term, ExpressionUtils::BASIC_OPERATORS)) {
                $secondNumber = $output->pop();
                $firstNumber = $output->pop();
                $operator = OperatorFactory::create($term);
                $result = $operator->process($firstNumber, $secondNumber);

                $output->push($result);
            } else {
                $output->push($term);
            }
        }

        return ['result' => $output->pop()];
    }
}
