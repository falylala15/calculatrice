<?php

namespace App\Service\Parser;

class Stack
{
    protected $data = [];

    public function push($element)
    {
        $this->data[] = $element;
    }

    public function peek()
    {
        return end($this->data);
    }

    public function pop()
    {
        return array_pop($this->data);
    }

    public function isEmpty()
    {
        return empty($this->data);
    }
}
