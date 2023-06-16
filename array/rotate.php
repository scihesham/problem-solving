<?php

declare(strict_types=1);
require_once '../pretty.php';



class Solution
{

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
    public function rightRotate(array $array): array
    {
        $arr_length = count($array);
        /** if empty array */
        if (!$arr_length) return $array;
        $last_element = $array[$arr_length - 1];
        for ($i = $arr_length - 2; $i >= 0; $i--) {
            $array[$i + 1] = $array[$i];
        }
        $array[0] = $last_element;
        return $array;
    }


    /**
     * Consider our Vector class. Add the member function: array leftRotate(array $array)
     * The function rotates the whole array 1 step to the left
     * However, in this case, the leftmost element will be 'rotated' around to the back of the array!
     * Example
     * Assume the array content is: 0 1 2 3 4
     * After a left rotation, it will be: 1 2 3 4 0
     * Notice how the 0 has 'rotated' to the tail of the array after applying left_rotate()
     * Ensure you avoid expanding the array's capacity
     */
    public function leftRotate(array $array): array
    {
        $arr_length = count($array);
        /** if empty array */
        if (!$arr_length) return $array;
        $first_element = $array[0];
        for ($i = 1; $i < $arr_length; $i++) {
            $array[$i - 1] = $array[$i];
        }
        $array[$arr_length - 1] = $first_element;
        return $array;
    }

    /**
     * Implement void array rightRotateTimes(int $times, array $array)
     * This one applies the right rotation times time
     * Assume array content is: 0 1 2 3 4
     * rightRotate(2) ⇒ it will be: 3 4 0 1 2
     * The challenge: times can be up to: 2000000000
     * Your code should be efficient to some extent
     */
    public function rightRotateTimes(int $times, array $array){
        $arr_length = count($array);
        $times = $times % $arr_length;
        for($i = 0; $i < $times; $i++){
            $array = $this->rightRotate($array);
        }
        return $array;
    }
}

$solution = new Solution();
$array = [0, 1, 2, 3, 4];
// dd($solution->rightRotate($array));
// dd($solution->leftRotate($array));
dd($solution->rightRotateTimes(5, $array));
