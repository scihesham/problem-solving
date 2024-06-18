<?php 

declare(strict_types=1);
require_once 'hashing.php';
require_once '../pretty.php';

class PhoneHashTable {
    public int $table_size;
    protected Hashing $hashing;
    protected array $table;

    function __construct(int $table_size)
    {
       $this->table_size = $table_size; 
       $this->hashing = new Hashing();
       $this->table = [];
    }

    public function hash(string $key): int
    {
        return $this->hashing->hashString(str: $key, size: $this->table_size);
    }

    public function getPhoneEntry(string $name){
        $index = $this->hash(key: $name);
        // dd($this->table);
        foreach($this->table[$index] ?? [] as $val){
            if($val->name == $name) return $val;
        }
        return null;
    }

    public function setPhoneEntry(PhoneEntry $phoneEntry): void{
        $index = $this->hash(key: $phoneEntry->name);
        $this->table[$index][] = $phoneEntry;
    }

}

$phoneHashTable = new PhoneHashTable(table_size: 20);
$phone_entry = new PhoneEntry(name: 'hesham', phone_number: '01025612848');
$phoneHashTable->setPhoneEntry(phoneEntry: $phone_entry);
$phone_entry = new PhoneEntry(name: 'samir', phone_number: '01281357549');
$phoneHashTable->setPhoneEntry(phoneEntry: $phone_entry);
$phone_entry = new PhoneEntry(name: 'hesham2', phone_number: '01021289585');
$phoneHashTable->setPhoneEntry(phoneEntry: $phone_entry);
$phone_number = $phoneHashTable->getPhoneEntry(name: 'hesham')?->phone_number ?? 'not found';
echo $phone_number;