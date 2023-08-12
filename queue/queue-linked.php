<?php
declare(strict_types = 1);
require_once '../pretty.php';
require_once '../single-linked-list/single-linked-list.php';

class Queue{
    private LinkedList $list;

    function __construct() {
        $this->list = new LinkedList();
    }

    public function enqueue(mixed $value): void{
        $this->list->insertEnd($value);
    }

    public function front(): ?Node{
        return $this->list->getHead();
    }

    public function size(): int{
        return $this->list->size();
    }

    public function dequeue(): void{
        $this->list->deleteNthNode(1);
    }

    public function isEmpty(): bool{
        return $this->list->isEmpty();
    }

    public function display(): void{
        $this->list->print();
    }

}


// $queue = new Queue();
// $queue->enqueue(10);
// $queue->enqueue(20);
// $queue->dequeue();
// $queue->enqueue(200);
// $queue->enqueue(300);
// $queue->enqueue(700);
// $queue->enqueue(800);
// $queue->display();