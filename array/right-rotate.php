<?php

declare(strict_types=1);
require_once '../pretty.php';

/**
 * Add the member function: array right_rotate(array $array)
 * The function shifts every element 1 step towards the right.
 * What about the rightmost element? It goes to the first idx
 * Example
 * Assume the array content is: 0 1 2 3 4
 * After a right rotation it will be: 4 0 1 2 3
 * Notice how, in this case, the '4' has been rotated to the head of the array!
 * Ensure you avoid expanding the array's capacity
 */

class Solution
{
    public function rightRotate(array $array): array
    {
        $arr_length = count($array);
        /** if empty array */
        if(!$arr_length) return $array;
        $last_element = $array[$arr_length - 1];
        for($i=$arr_length-2;$i>=0; $i--){
            $array[$i+1] = $array[$i];
        }
        $array[0] = $last_element;
        return $array;
    }

}

$solution = new Solution();
$array = [0, 1, 2, 3, 4];
dd($solution->rightRotate($array));
