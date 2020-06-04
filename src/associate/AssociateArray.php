<?php

namespace src\associate;

use src\exceptions\AssociateArrayKeyException;
use src\exceptions\ExceptionMessages;

class AssociateArray
{
    public array $AssociateList;

    protected int $count = 0;

    public function __construct()
    {
        $this->AssociateList = array();
    }

    public function add($value, $index): void
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
            throw new AssociateArrayKeyException(ExceptionMessages::$message['common']['indexExist']);
        }
    }

    public function offsetExists($index): ?bool
    {
        if (array_key_exists($index, $this->AssociateList))
            return true;
        else return false;
    }

    public function valueByKey($key)
    {
        if(array_key_exists($key, $this->AssociateList)) {
            return $this->AssociateList[$key];
        } else {
            throw new AssociateArrayKeyException(ExceptionMessages::$message['common']['indexExist']);
        }
    }
}