<?php
declare(strict_types = 1);
require_once '../pretty.php';

class Stack{
    protected int $top = -1;
    protected array $array = [];

    public function push(mixed $val): void{
        $this->array[++$this->top] = $val;
    }

    public function pop(): mixed{
        assert($this->top != -1);
        return $this->array[$this->top--];
    }

    public function peek(): mixed{
        assert($this->top != -1);
        return $this->array[$this->top];
    }

    public function display(): void{
        for($i=$this->top; $i>=0; $i--){
            echo $this->array[$i] . ' ';
        }
    }

}

$stack = new Stack();
$stack->push(10);
$stack->push(20);
$stack->push(30);
echo $stack->pop();
echo "<br>";
echo $stack->peek();
echo "<br>";
$stack->push(40);
$stack->push(50);
echo $stack->peek();
echo "<br>";
$stack->display();
echo "<br>";