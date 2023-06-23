<?php

use Solution as GlobalSolution;

require_once 'stack-linked.php';

/**
 *  convert infix to postfix
 *  consider operators => +, -, *, /
 *  consider parentheses ()
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
            else if($char == '('){
                $operators->push($char);
            }
            else if($char == ')'){
                while($operators->peek() != '('){
                    $postfix .= $operators->pop();
                }
                $operators->pop();
            }
            else{
                while(!$operators->isEmpty() && ($this->precedence($operators->peek()) >= $this->precedence($char))){
                    $postfix .= $operators->pop();
                }
                $operators->push($char);
            }
        }

        while(!$operators->isEmpty()){
            $postfix .= $operators->pop();
        }

        return $postfix;
    }
    
}

$solution = new Solution();
// $infix = '1+3*5-8/2';
$infix = '2+3-((5+2)*3)';
echo $solution->infixToPostfix($infix);
