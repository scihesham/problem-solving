<?php

declare(strict_types=1);
require_once '../pretty.php';
require_once 'tree.php';

/**
 * You are given the root of a binary search tree (BST) and an integer val.
 * Find the node in the BST that the node's value equals val
 * and return the subtree rooted with that node. If such a node does not exist, return null.
 */

class Solution
{
    /**
     * @param TreeNode $root
     * @param Integer $val
     * @return ?TreeNode
     */
    function search_BST($root, $val): ?TreeNode
    {
        if (!$root) return null;

        if ($val == $root->val) {
            return $root;
        }

        if ($val < $root->val) {
            return self::search_BST($root->left, $val);
        } else {
            return self::search_BST($root->right, $val);
        }
    }
}

$tree = new BinaryTree(50);
$tree->add([30, 10, 12], ['L', 'L', 'R']);
$tree->insert_bst(40);
$tree->insert_bst(20);
$tree->insert_bst(70);

$solution = new Solution();
$res = $solution->search_BST($tree->getRoot(), 30);
$tree->_print_inorder($res);
