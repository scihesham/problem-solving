<?php

declare(strict_types=1);
require_once '../pretty.php';

class TreeNode
{
    public mixed $val;
    public TreeNode|null $left = null;
    public TreeNode|null $right = null;

    function __construct(mixed $val)
    {
        $this->val = $val;
    }
}

class BinaryTree
{
    private TreeNode $root;

    function __construct(mixed $val)
    {
        $this->root = new TreeNode($val);
    }

    public function getRoot(){
        return $this->root;
    }

    public function add(array $values, array $directions): void
    {
        /** check that 2 arrays have the same size */
        assert(count($values) == count($directions));
        $current = $this->root;
        for ($i = 0, $values_size = count($values); $i < $values_size; $i++) {
            /** if direction is left */
            if ($directions[$i] == 'L') {
                if (!$current->left) {
                    $current->left = new TreeNode($values[$i]);
                } else {
                    /** check that the user enter right inputs */
                    assert($current->left->val == $values[$i]);
                }
                $current = $current->left;
            }
            /** if direction is right */
            else {
                if (!$current->right) {
                    $current->right = new TreeNode($values[$i]);
                } else {
                    /** check that the user enter right inputs */
                    assert($current->right->val == $values[$i]);
                }
                $current = $current->right;
            }
        }
    }

    public function _print_inorder(TreeNode|null $current): void
    {
        if (!$current) return;
        $this->_print_inorder($current->left);
        echo $current->val . ' ';
        $this->_print_inorder($current->right);
    }

    public function print_inorder(): void
    {
        $this->_print_inorder($this->root);
    }
}

// $tree = new BinaryTree(1);
// $tree->add([2, 4, 7], ['L', 'L', 'L']);
// $tree->add([2, 4, 8], ['L', 'L', 'R']);
// $tree->add([2, 5, 9], ['L', 'R', 'R']);
// $tree->add([3, 6, 10], ['R', 'R', 'L']);

// $tree->print_inorder(); // 7 4 8 2 5 9 1 3 10 6

