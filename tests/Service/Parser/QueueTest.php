<?php

namespace App\Tests\Service\Parse;

use App\Service\Parser\Queue;
use PHPUnit\Framework\TestCase;

class QueueTest extends TestCase
{
    public function testEmpty(): void
    {
        $queue = new Queue();

        $this->assertTrue($queue->isEmpty());
    }

    /**
     * @depends testEmpty
     */
    public function testEnqueueAndDequeue() : void
    {
        $queue = new Queue();
        $queue->enqueue('foo');
        $this->assertSame(['foo'], $queue->getData());

        $queue->dequeue();
        $this->assertSame(0, count($queue->getData()));
        $this->assertEmpty($queue->getData());
    }
}