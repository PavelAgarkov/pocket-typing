<?php

namespace src\associate;

use src\exceptions\AssociateArrayKeyException;

class AssociateArray
{
    public array $AssociateList;

    protected int $count = 0;

    public function __construct()
    {
        $this->AssociateList = array();
    }

    public function add($index, $value): void
    {
        $this->AssociateList[$index] = $value;
        $this->count++;
    }

    public function getArray(): ?array
    {
        return $this->AssociateList;
    }

    public function getCountElements(): ?int
    {
        return $this->count;
    }

    public function getFirst(): ?object
    {
        return current($this->AssociateList);
    }

    public function offsetUnset(string $index): void
    {
        if(array_key_exists($index, $this->AssociateList)) {
            unset($this->AssociateList[$index]);
        } else {
            throw new AssociateArrayKeyException('В ключах массива нет переданного аргумента');
        }
    }

    public function offsetExists($index): ?bool
    {
        if (array_key_exists($index, $this->AssociateList))
            return true;
        else return false;
    }
}