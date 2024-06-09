<?php
declare(strict_types = 1);
require_once '../pretty.php';

class Node{
    public mixed $data;
    public ?Node $next = null;

    function __construct(mixed $data) {
        $this->data = $data;
    }
}

class Stack{
    protected ?Node $head = null;

    public function push(mixed $val): void{
        $node = New Node($val);
        $node->next = $this->head;
        $this->head = $node;
    }

    public function pop(): mixed{
        assert($this->head);
        $temp = $this->head;
        $this->head = $temp->next;
        return $temp->data;
    }

    public function peek(): mixed{
        assert($this->head);
        return $this->head->data;
    }

    public function isEmpty(): bool{
        return !$this->head;
    }

    public function display(){
        for($temp=$this->head; $temp; $temp=$temp->next){
            echo $temp->data. ' ';
        }
    }

}


// $stack = new Stack();
// $stack->push(10);
// $stack->push(20);
// $stack->push(30);
// echo $stack->pop();
// echo "<br>";
// echo $stack->peek();
// echo "<br>";
// $stack->push(40);
// $stack->push(50);
// echo $stack->peek();
// echo "<br>";
// $stack->display();
// echo "<br>";