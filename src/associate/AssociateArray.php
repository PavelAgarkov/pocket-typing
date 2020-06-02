<?php

namespace src\ASSOCIATE;

class AssociateArray
{
    public \stdClass $AssociateList;

    protected int $count = 0;

    public function __construct()
    {
        $this->AssociateList = new \stdClass();
    }

    public function add($index, $value): void
    {
        $this->AssociateList->$index = $value;
        $this->count++;
    }

    public function getArray(): ?array
    {
        return (array) $this->AssociateList;
    }

    public function getCountElements(): ?int
    {
        return $this->count;
    }

    public function getFirst(): ?object
    {
        return current(get_object_vars($this->AssociateList));
    }

}