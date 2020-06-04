<?php

namespace src\types;

use src\ObjectArray;
use src\TypeQualifier;
use src\types\InterfaceType;

abstract class Type implements InterfaceType
{
    public $Object;

    abstract public function insert($value , $index = null): void;

    abstract public function validation($value, $index, $type, $indexType, TypeQualifier $Qualifier): void;

    abstract public function delete($index): ?object;

    abstract public function getAsArray(): ?array;

    abstract public function isEmpty(): ?bool;

    abstract public function getFirstElement(): ?object;

    abstract public function offsetExist($index): ?bool;

    abstract public function count(): ?int;

    abstract public function valueByKey($key);
}