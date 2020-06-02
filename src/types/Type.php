<?php

namespace SRC\TYPES;

use SRC\ObjectArray;
use SRC\TypeQualifier;
use SRC\TYPES\InterfaceType;

abstract class Type implements InterfaceType
{
    public $Object;

    abstract public function insert(ObjectArray $Array, $value , $index = null): void;

    abstract public function validation($value, $index, $type, $indexType, TypeQualifier $Qualifier): void;

    abstract public function delete($index): void;

    abstract public function getAsArray(): ?array;

    abstract public function isEmpty(): ?bool;

    abstract public function getFirstElement(): ?object;
}