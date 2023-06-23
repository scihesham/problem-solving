<?php

use Solution as GlobalSolution;

require_once 'stack-linked.php';

/**
 *  convert infix to postfix
 */

class Solution
{
    public function precedence(string $operator): int
    {
        if ($operator == '+' || $operator == '-') {
            return 1;
        } elseif ($operator == '*' || $operator == '/') {
            return 2;
        }

        return 0;
    }

    public function infixToPostfix(string $infix): string
    {
        $postfix = '';
        $operators = new Stack();
        
        foreach (str_split($infix) as $char) {
            /** if operand */
            if(is_numeric($char)){
                $postfix .= $char;
            }
            /** if operator */
            else{
                while(!$operators->isEmpty() && ($this->precedence($operators->peek()) >= $this->precedence($char))){
                    $operator = $operators->pop();
                    $postfix .= $operator;
                }
                $operators->push($char);
            }
        }

        while(!$operators->isEmpty()){
            $operator = $operators->pop();
            $postfix .= $operator;
        }

        return $postfix;
    }
    
}

$solution = new Solution();
$infix = '1+3*5-8/2';
echo $solution->infixToPostfix($infix);
