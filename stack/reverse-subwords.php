<?php
require_once 'stack-linked.php';

/**
 *  Develop: string reverseSubwords(string $line)
 *  It takes a string of spaces, e.g. "abc d efg xy"
 *  Then reverse each subword ⇒ “cba d gfe yx“
 */
 
 class Solution extends Stack{
    
    public function reverseSubwords(string $line): string{
        $stack = new Stack();
        $reversed_word = '';
        $str_array = str_split($line);
        foreach($str_array as $char){
            if($char == ' '){
                while($stack->head){
                    $reversed_word .= $stack->pop();
                }
                $reversed_word .= ' ';
            }
            else{
                $stack->push($char);
            }
        }
        while($stack->head){
            $reversed_word .= $stack->pop();
        }
        return $reversed_word;
    }

 }

 $solution = new Solution();
 $line = 'abc d efg xy';
 echo $solution->reverseSubwords($line);