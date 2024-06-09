<?php 
declare(strict_types = 1);
require_once '../pretty.php';
require_once 'tree.php';

/**
 * Create a class Solution. Inside it function called maxValue 
 * It returns the maximum value in the whole tree
 * The function should be recursive 
 * i.e. similar to the pre-order traversal
 * You can assume we never call with a null tree
 */

class Solution {

    public function maxValue(TreeNode|null $current): int{
        if(! $current) return 0;

        $l = self::maxValue($current->left);
        $r = self::maxValue($current->right);
        return max($current->val, max($l, $r));
    }

}

$tree = new BinaryTree(1);
$tree->add([2, 4, 7], ['L', 'L', 'L']);
$tree->add([2, 4, 8], ['L', 'L', 'R']);
$tree->add([2, 5, 9], ['L', 'R', 'R']);
$tree->add([3, 6, 10], ['R', 'R', 'L']);

$solution = new Solution();
echo $solution->maxValue($tree->getRoot());
