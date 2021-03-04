<?php

namespace App\Service\Parser;

class Queue
{
    private $data = [];

    public function enqueue($element)
    {
        $this->data[] = $element;
    }

    public function dequeue()
    {
        return array_shift($this->data);
    }

    public function isEmpty()
    {
        return empty($this->data);
    }

    public function getData()
    {
        return $this->data;
    }
}
