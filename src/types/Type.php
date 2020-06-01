<?php

namespace SRC\TYPES;

use SRC\ObjectArray;
use SRC\TypeQualifier;
use SRC\TYPES\InterfaceType;

abstract class Type implements InterfaceType
{
    public string $type;

    abstract public function insert(ObjectArray $Array, $value , $index = null): void;

    abstract public function validation($value, $index, $type, $indexType, TypeQualifier $Qualifier);
}