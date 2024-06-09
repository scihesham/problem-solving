<?php

declare(strict_types=1);
require_once '../pretty.php';

class Hashing
{
    public function hashNum(int $number, int $size): int
    {
        // Hashed value in range [0, size-1]
        // return $number % $size;
        /** handle negative values */
        return ($number % $size + $size) % $size;
    }

    public function hashString(string $str, int $size): int
    {
        $sum = 0;
        foreach (str_split($str) as $char) {
            $sum += ord($char);
        }
        return $sum % $size;
    }
}

$hashing = new Hashing();
// echo $hashing->hashString(str: 'abcde', size: 26);
echo $hashing->hashNum(number: 20, size: 2147483647);