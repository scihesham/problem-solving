<?php

declare(strict_types=1);
require_once '../pretty.php';
require_once 'tree.php';

/**
 * Given the root of a binary tree and an integer targetSum,
 * return true if the tree has a root-to-leaf path such
 * that adding up all the values along the path equals targetSum. 
 * A leaf is a node with no children
 */

class Solution
{
    function hasPathSum(?TreeNode $root, int $targetSum): bool
    {
        if (!$root) return false;
        if ($this->isLeaf($root) && ($targetSum == $root->val)) {
            return true;
        }

        $targetSum -= $root->val;
        $l = $this->hasPathSum($root->left, $targetSum);
        $r = $this->hasPathSum($root->right, $targetSum);

        return $l || $r;
    }

    function isLeaf(?TreeNode $node): bool
    {
        return $node && !$node->left && !$node->right;
    }
}

$tree = new BinaryTree(1);
$tree->add([2, 4, 7], ['L', 'L', 'L']);
$tree->add([2, 4, 8], ['L', 'L', 'R']);
$tree->add([2, 5, 9], ['L', 'R', 'R']);
$tree->add([3, 6, 10], ['R', 'R', 'L']);

$solution = new Solution();
echo $solution->hasPathSum($tree->getRoot(), 20) ?: 'false';
