<?php
declare(strict_types = 1);
require_once '../pretty.php';

class CircularQueue{
    private SplFixedArray $array;
    private int $front = -1;
    private int $rear = -1;
    private int $added_elements = 0;
    private int $array_size = 0;

    function __construct(int $array_size) {
        $this->array = new SplFixedArray($array_size);
        $this->array_size = $array_size; 
    }

    private function next($index): int{
        if($index == $this->array_size - 1){
            return 0;
        }
        return $index+1;
    }

    public function isFull(): bool{
        return $this->added_elements == $this->array_size;
    }

    public function isEmpty(): bool{
        return $this->added_elements == 0;
    }

    public function enqueue(mixed $value): void{
        assert(!$this->isFull());
        $next_index = $this->next($this->rear);
        $this->array[$next_index] = $value;
        $this->added_elements++;
        $this->rear = $next_index;
        if($this->front==-1){
            $this->front = 0;
        }
    }

    public function dequeue(): int{
        assert(!$this->isEmpty());
        $value = $this->array[$this->front];
        $this->front = $this->next($this->front);
        $this->added_elements--;
        return $value;
    }

    public function display(): void{
        for($i=0,$current=$this->front; $i < $this->added_elements; $i++, $current=$this->next($current)){
            echo $this->array[$current].' ';
        }
    }

}

$queue = new CircularQueue(5);
$queue->enqueue(10);
$queue->enqueue(20);
$queue->dequeue();
$queue->dequeue();
$queue->enqueue(200);
$queue->enqueue(300);
$queue->display();