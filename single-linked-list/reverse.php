<?php
require_once 'single-linked-list.php';


/**
 * Given a list, reverse all its nodes (addresses)
 * E.g. {1, 2, 3, 4, 5} ⇒ {5, 4, 3, 2, 1}
 * void reverse(LinkedList $list)
 */

 
 class Solution extends LinkedList {
    public function reverse(LinkedList $list): void{
        $prev = $list->head;
        $current = $list->head->next;
        while($current){
            $next = $current->next;
            $current->next = $prev;
            $prev = $current;
            $current = $next;
        }
        $list->tail = $list->head;
        $list->tail->next = null;
        $list->head = $prev;
    }
 }

$linked_list = new LinkedList();
$linked_list->insertEnd(6);
$linked_list->insertEnd(8);
$linked_list->insertEnd(10);
$linked_list->insertEnd(15);


$linked_list->print();
echo "<br>";
$solution = new Solution();
$solution->reverse($linked_list);
$linked_list->print();
echo "<br>";
