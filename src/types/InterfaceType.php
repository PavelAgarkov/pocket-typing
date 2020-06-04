<?php

namespace src\types;

use src\ObjectArray;
use src\TypeQualifier;

interface InterfaceType
{
    public function insert($value , $index = null): void;

    public function validation($value, $index, $type, $indexType, TypeQualifier $Qualifier): void;

    public function delete($index): ?object;

    public function getAsArray(): ?array;

    public function isEmpty(): ?bool;

    public function getFirstElement(): ?object;

    public function offsetExist($index): ?bool;

    public function count(): ?int;

    public function valueByKey($key);

}
