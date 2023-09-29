<?php

declare(strict_types=1);
require_once '../pretty.php';

class MinHeap
{
    private int $top = 0;
    private array $array = [];
    private int $size = 0;

    private function leftChildIndex(int $parent_index): int
    {
        $pos = $parent_index * 2 + 1;
        return $pos >= $this->size ? -1 : $pos;
    }

    private function rightChildIndex(int $parent_index): int
    {
        $pos = $parent_index * 2 + 2;
        return $pos >= $this->size ? -1 : $pos;
    }

    /**
     * post condition => check that this function doesn't return -1
     */
    private function parentIndex(int $child_index): int
    {
        if ($child_index == 0) return -1;
        $pos = intval(($child_index - 1) / 2);
        return $pos;
    }

    /**
     * post condition => check that this function doesn't return -1
     */
    private function heapifyUp($child_index): int
    {
        $parent_index = $this->parentIndex($child_index);
        if ($parent_index == -1) return -1;
        if ($this->array[$child_index] < $this->array[$parent_index]) {
            /** swap values */
            [$this->array[$child_index], $this->array[$parent_index]] = [$this->array[$parent_index], $this->array[$child_index]];
            return $parent_index;
        }
        return -1;
    }

    /**
     * post condition => check that this function doesn't return -1
     */
    private function heapifyDown(int $parent_index): int
    {
        $left_child_index = $this->leftChildIndex($parent_index);
        $right_child_index = $this->rightChildIndex($parent_index);
        /** if no children */
        if ($left_child_index == -1) return -1;
        if($right_child_index == -1){
            $min_child_index = $left_child_index;
        }
        else{
            $min_child_index = $this->array[$left_child_index] < $this->array[$right_child_index] ? $left_child_index : $right_child_index;
        }
        if ($this->array[$parent_index] > $this->array[$min_child_index]) {
            /** swap values */
            [$this->array[$parent_index], $this->array[$min_child_index]] = [$this->array[$min_child_index], $this->array[$parent_index]];
            return $min_child_index;
        }
        return -1;
    }

    public function push(mixed $node_val)
    {
        $this->array[$this->size] = $node_val;
        $child_index = $this->size++;
        while ($child_index != -1) {
            $child_index = $this->heapifyUp($child_index);
        }
    }

    public function pop(): mixed
    {
        assert($this->size);
        $tmp_node_val = $this->array[0];
        $this->array[0] = $this->array[--$this->size];
        $parent_index = 0;
        while ($parent_index != -1) {
            $parent_index = $this->heapifyDown($parent_index);
        }
        return $tmp_node_val;
    }

    public function display(): void
    {
        for ($i = $this->top; $i < $this->size; $i++) {
            echo $this->array[$i] . ' ';
        }
    }
}

$min_heap = new MinHeap;

$min_heap->push(4);
$min_heap->push(3);
$min_heap->push(7);
$min_heap->push(8);
$min_heap->push(10);
$min_heap->push(5);
$min_heap->push(2);

$min_heap->display(); // 2 4 3 8 10 7 5
echo "<br>";
echo $min_heap->pop();
echo "<br>";
$min_heap->display(); // 3 4 5 8 10 7
echo "<br>";
echo $min_heap->pop();
echo "<br>";
$min_heap->display(); // 4 7 5 8 10
