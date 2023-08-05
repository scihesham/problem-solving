<?php

declare(strict_types=1);
require_once '../pretty.php';
require_once 'tree.php';

/**
 * Given the root of a binary tree, return its maximum depth.
 * A binary tree's maximum depth is the number of
 * nodes along the longest path from the root node
 * down to the farthest leaf node.
 */

class Solution
{
    function maxDepth(TreeNode|null $current) : int{
        if(! $current) return 0;
        $left_depth = self::maxDepth($current->left);
        $right_depth = self::maxDepth($current->right);
        return max($left_depth, $right_depth) + 1;
    }
}

$tree = new BinaryTree(1);
$tree->add([2, 4, 7], ['L', 'L', 'L']);
$tree->add([2, 4, 8], ['L', 'L', 'R']);
$tree->add([2, 5, 9], ['L', 'R', 'R']);
$tree->add([3, 6, 10], ['R', 'R', 'L']);

$solution = new Solution();
echo $solution->maxDepth($tree->getRoot());
