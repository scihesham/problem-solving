<?php
require_once 'single-linked-list.php';

/**
 * Given a list, swap each 2 consecutive values
 * ● E.g. {1, 2, 3, 4} ⇒ {2, 1, 4, 3}
 * ● E.g. {1, 2, 3, 4, 5} ⇒ {2, 1, 4, 3, 5}
 *  void swap_pairs(LinkedList $list)
 */

 class Solution extends LinkedList {
    public function swap_pairs(LinkedList $list){
        for($current=$list->head; $current; $current=$current->next){
            if($current->next){
                /** swapping data */
                list($current->data, $current->next->data) = array($current->next->data, $current->data);
                $current = $current->next;
            }
        }
    }
 }


$linked_list = new LinkedList();
$linked_list->insertEnd(4);
$linked_list->insertEnd(6);
$linked_list->insertEnd(8);
$linked_list->insertEnd(5);
$linked_list->insertEnd(10);

$linked_list->print();
echo "<br>";
$solution = new Solution();
$solution->swap_pairs($linked_list);
$linked_list->print();
echo "<br>";