<?php

require_once 'circular-queue.php';

/**
 * Deque is a Double ended queue where you can add/remove from either
 * rear or front. It is not FIFO anymore, but provides great flexibility
 * Change the circular queue to include
 * void enqueueFront(int $value)
 * int dequeueRear() 
 * O(1) time complexity for all methods
 */

class Solution extends CircularQueue
{
    public CircularQueue $circular_queue;

    function __construct()
    {
        $this->circular_queue = new CircularQueue(6);
    }

    public function previous($index): int
    {
        if ($index == -1) {
            return 0;
        }
        else if ($index == 0) {
            return $this->circular_queue->array_size - 1;
        }
        return $index - 1;
    }

    public function enqueueFront(int $value): void
    {
        assert(!$this->circular_queue->isFull());
        $previous_index = $this->previous($this->circular_queue->front);
        $this->circular_queue->array[$previous_index] = $value;
        $this->circular_queue->front = $previous_index;
        $this->circular_queue->added_elements++;
        if($this->circular_queue->rear == -1){
            $this->circular_queue->rear = 0;
        }
    }

    public function dequeueRear(): int
    {
        assert(!$this->circular_queue->isEmpty());
        $value = $this->circular_queue->array[$this->circular_queue->rear];
        $this->circular_queue->rear = $this->previous($this->circular_queue->rear);
        $this->circular_queue->added_elements--;
        return $value;
    }


}

$solution = new Solution();
$solution->enqueueFront(3);
$solution->enqueueFront(2);
$solution->circular_queue->enqueue(4);
$solution->enqueueFront(1);
$solution->circular_queue->display();
echo "<br>";
$solution->dequeueRear();
$solution->circular_queue->display();
echo "<br>";
$solution->circular_queue->dequeue();
$solution->circular_queue->display();
echo "<br>";
$solution->dequeueRear();
$solution->circular_queue->dequeue();
$solution->circular_queue->enqueue(7);
$solution->circular_queue->display();
echo "<br>";
