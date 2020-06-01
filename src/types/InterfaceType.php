<?php

namespace SRC\TYPES;

use SRC\ObjectArray;
use SRC\TypeQualifier;

interface InterfaceType
{
    public function insert(ObjectArray $Array, $value , $index = null): void;

    public function validation($value, $index, $type, $indexType, TypeQualifier $Qualifier);
}
