<?php
declare(strict_types = 1);

class Node{
    public mixed $data;
    public Node|null $next = null;
    public Node|null $prev = null;

    function __construct(mixed $data){
        $this->data = $data;
    }
}

class DoublyLinkedList{
    protected Node|null $head = null;
    protected Node|null $tail = null;

    public function print(){
        $current = $this->head;
        while($current){
            echo $current->data . " ";
            $current = $current->next;
        }
    }

    public function printReversed(){
        $current = $this->tail;
        while($current){
            echo $current->data . " ";
            $current = $current->prev;
        }
    }

    public function insertEnd(mixed $n): void {
        $node = new Node($n);
        /** if linked list not empty */
        if($this->head){
            $tmp = $this->tail;
            $this->tail->next = $node;
            $this->tail = $node;
            $this->tail->prev = $tmp;
        }
        /** if linked list empty */
        else{
            $this->head = $this->tail = $node;
        }
    }

    public function getNthNode(int $index): null|Node {
        $cnt = 0;
        for($current=$this->head; $current; $current = $current->next){
            if(++$cnt == $index) return $current;
        }
        return null;
    }

    public function deleteNthNode(int $index): void{
        if($index == 1){
            // delete head
            $this->deleteNode($this->head, is_head: true);
        }
        $node_before = $this->getNthNode($index-1);
        if($node_before){
            $this->deleteNode($node_before);
        }
    }

    /**
     * @param Node $node => head or node_previos
    */
    public function deleteNode(Node $node, bool $is_head=false): void{
        if($is_head){
            $this->head = $node->next;
            /** if the list was a single node */
            if(! $this->head){
                $this->tail = null;
            }
            else{
                $this->head->prev = null;
            }
        }
        else{
            /** check if the deleted node is the tail */
            $is_delete_tail = $node->next == $this->tail;
            $node->next = $node->next->next;
            if($is_delete_tail){
                $this->tail = $node;
            }
        }
    }

}

$linked_list = new DoublyLinkedList();
$linked_list->insertEnd(4);
$linked_list->insertEnd(6);
$linked_list->insertEnd(8);
$linked_list->insertEnd(10);

$linked_list->print();
echo "<br>";
$linked_list->deleteNthNode(3);
$linked_list->print();
echo "<br>";
$linked_list->insertEnd(20);
$linked_list->insertEnd(50);
$linked_list->print();
echo "<br>";
$linked_list->deleteNthNode(1);
$linked_list->print();
echo "<br>";