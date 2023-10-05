<?php

declare(strict_types=1);
require_once '../pretty.php';

class Trie
{
    private array $child;
    private bool $isLeaf = false;

    function __construct()
    {
        foreach(range('a', 'z') as $char){
            $this->child[$char] = null;
        }
    }

    public function insert(string $str){
        $str_charcters = str_split($str);
        $this->_insert(str_charcters: $str_charcters);
    }

    public function _insert(array $str_charcters, int $index=0){
        if(count($str_charcters) == $index){
            $this->isLeaf = true;
        }
        else{
            $this->child[$str_charcters[$index]] = $this->child[$str_charcters[$index]] ?: new Trie();
            $this->child[$str_charcters[$index]]->_insert($str_charcters, $index+1);
        }
    }

    public function isWordExist(string $str): bool{
        $str_charcters = str_split($str);
        return $this->_isWordExist(str_charcters: $str_charcters);
    }

    public function _isWordExist(array $str_charcters, int $index=0): bool{
        if(count($str_charcters) == $index){
            return $this->isLeaf;
        }
        if(! $this->child[$str_charcters[$index]]) return false;
        return $this->child[$str_charcters[$index]]->_isWordExist($str_charcters, $index+1);
    }

    public function isPrefixExist(string $str): bool{
        $str_charcters = str_split($str);
        return $this->_isPrefixExist(str_charcters: $str_charcters);
    }

    public function _isPrefixExist(array $str_charcters, int $index=0): bool{
        if(count($str_charcters) == $index){
            return true;
        }
        if(! $this->child[$str_charcters[$index]]) return false;
        return $this->child[$str_charcters[$index]]->_isPrefixExist($str_charcters, $index+1);
    }


}        

$root = new Trie();
$root->insert('abc');
$root->insert('abd');
// dd($root);

echo $root->isWordExist('abd') ?: 'not existed';
echo "<br>";
echo $root->isPrefixExist('aa') ?: 'not existed';

