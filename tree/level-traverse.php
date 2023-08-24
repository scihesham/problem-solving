<?php

declare(strict_types=1);
require_once '../pretty.php';
require_once 'tree.php';
require_once '../queue/queue-linked.php';

/**
 * Print nodes level by level, knowing level
 */
class Solution
{

    public Queue $queue;

    function __construct()
    {
        $this->queue = new Queue();
    }

    public function levelOrderTraverse(?TreeNode $root): void
    {
        if (!$root) return;

        $levels_num = 0;
        $this->queue->enqueue($root);
        while (!$this->queue->isEmpty()) {
            $level_nodes_num = $this->queue->size();
            while ($level_nodes_num) {
                $current = $this->queue->front();
                $this->queue->dequeue();
                echo $current->data->val . " ";
                if ($current->data->left) {
                    $this->queue->enqueue($current->data->left);
                }
                if ($current->data->right) {
                    $this->queue->enqueue($current->data->right);
                }
                $level_nodes_num--;
            }
            $levels_num++;
        }
    }

}

$tree = new BinaryTree(1);
$tree->add([2, 4, 7], ['L', 'L', 'L']);
$tree->add([2, 4, 8], ['L', 'L', 'R']);
$tree->add([2, 5, 9], ['L', 'R', 'R']);
$tree->add([3, 6, 10], ['R', 'R', 'L']);

$solution = new Solution();
$solution->levelOrderTraverse($tree->getRoot());
