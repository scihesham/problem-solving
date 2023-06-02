<?php
require_once 'single-linked-list.php';
/**
 * Given a list, delete the first node with the given key value
 * E.g. {1, 2, 3, 4, 2, 6}, val = 2 ⇒ {1, 3, 4, 2, 6}
 * void delete_node_with_val(LinkedList $list, int value)
 */

class Solution extends LinkedList {
    public function delete_node_with_val(LinkedList $list, int $value): void{
        $cnt = 1;
        for($current=$list->head; $current; $current=$current->next){
            if($current->data == $value){
                $list->deleteNthNode($cnt);
                return;
            }
            else{
                $cnt++;
            }

        }
    }
}


$linked_list = new LinkedList();
$linked_list->insertEnd(4);
$linked_list->insertEnd(6);
$linked_list->insertEnd(8);
$linked_list->insertEnd(4);
$linked_list->insertEnd(10);

$linked_list->print();
echo "<br>";
$solution = new Solution();
$solution->delete_node_with_val($linked_list, 4);
$linked_list->print();
echo "<br>";
