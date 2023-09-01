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

    public function getRoot()
    {
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

    public function parenthesize(): string
    {
        return $this->_parenthesize($this->root);
    }

    public function _parenthesize(?TreeNode $current): string
    {
        if (!$current) return '()';

        $repr = "(" . $current->val;

        $left_repr = self::_parenthesize($current->left);
        $right_repr = self::_parenthesize($current->right);

        $repr .= $left_repr;
        $repr .= $right_repr;
        $repr .= ")";

        return $repr;
    }


    public function parenthesize_canonical(): string
    {
        return $this->_parenthesize_canonical($this->root);
    }

    public function _parenthesize_canonical(?TreeNode $current): string
    {
        if (!$current) return '()';
        $array = [];
        $repr = "(" . $current->val;

        $left_repr = self::_parenthesize_canonical($current->left);
        $right_repr = self::_parenthesize_canonical($current->right);

        $array[] = $left_repr;
        $array[] = $right_repr;
        sort($array);
        
        foreach($array as $val){
            $repr .= $val;  
        }

        $repr .= ")";
        
        return $repr;
    }

    public function searchBST(int $target): bool{
		return self::_searchBST($this->root, $target);
	}

    public function _searchBST(?TreeNode $current, mixed $target): bool{
        if(! $current) return false;

        if($current->val == $target) return true;

        if($target < $current->val) return self::_searchBST($current->left, $target);
            
        else return self::_searchBST($current->right, $target);
    }

    public function insert_bst(int $target): void{
		self::_insert_bst($this->root, $target);
	}

    public function _insert_bst(?TreeNode $current, int $target): void{
            if($target < $current->val){
                if($current->left) self::_insert_bst($current->left, $target);
                else $current->left = new TreeNode($target);
            }
            else if($target > $current->val){
                if($current->right) self::_insert_bst($current->right, $target);
                else $current->right = new TreeNode($target);
            }
            else {
                // exists already
            }
	}

    public function min_val(?TreeNode $current): ?TreeNode{
        if(!$current) return null;
        while($current->left){
            $current = $current->left;
        }
        return $current;
    }

    public function find_chain(?TreeNode $current, int $target, array &$arr): bool{
        if(!$current) return false;

        $arr[] = $current;

        if($target == $current->val) return true;

        if($target > $current->val){
            return self::find_chain($current->right, $target, $arr);
        }
        else{
            return self::find_chain($current->left, $target, $arr);
        }
    }

    public function successor(int $target): ?int{
        $arr = array();
        $find_chain_res = self::find_chain($this->root, $target, $arr);
        if(! $find_chain_res) return null;

        $current = array_pop($arr);
        if($current->right){
          return self::min_val($current->right)->val;
        }

        $parent = array_pop($arr);
        while($parent && $parent->right == $current){
            $current = $parent;
            $parent = array_pop($arr);
        }

        if($parent){
            return $parent->val;
        }
        else{
            return null;
        }

    }



}

function test1()
{
    $tree = new BinaryTree(1);
    $tree->add([2, 4, 7], ['L', 'L', 'L']);
    $tree->add([2, 4, 8], ['L', 'L', 'R']);
    $tree->add([2, 5, 9], ['L', 'R', 'R']);
    $tree->add([3, 6, 10], ['R', 'R', 'L']);

    $tree->print_inorder(); // 7 4 8 2 5 9 1 3 10 6
}

function test2()
{
    $tree = new BinaryTree(1);

    $tree->add([3], ['L']);
    $tree->add([2], ['R']);

    echo $tree->parenthesize();
    echo "<br>";
    echo $tree->parenthesize_canonical();
}

function test3()
{
    $tree = new BinaryTree(1);

    $tree->add([3, 8], ['L', 'R']);
    $tree->add([2], ['R']);

    echo $tree->parenthesize();
    echo "<br>";
    echo $tree->parenthesize_canonical();
}

/** binary search tree */
function test4()
{
    $tree = new BinaryTree(50);

    $tree->add([30, 10, 12], ['L', 'L', 'R']);
    $tree->add([30, 40], ['L', 'R']);
    $tree->add([70, 60, 55], ['R', 'L', 'L']);
    $tree->add([70, 80, 90], ['R', 'R', 'R']);

    echo $tree->searchBST(40) ?: 'Not Found';

}

function test5()
{
    $tree = new BinaryTree(50);
    $tree->add([30, 10, 12], ['L', 'L', 'R']);
    $tree->insert_bst(40);
    $tree->insert_bst(20);
    $tree->insert_bst(70);
    $tree->print_inorder(); // 10 12 20 30 40 50 70
}


function testSuccessor()
{
    $tree = new BinaryTree(50);
    $tree->add([30, 10, 12], ['L', 'L', 'R']);
    $tree->insert_bst(40);
    $tree->insert_bst(20);
    $tree->insert_bst(70);
    $tree->print_inorder(); // 10 12 20 30 40 50 70
    echo "<br>";
    echo $tree->successor(50) ?? 'not found';
}

testSuccessor();
