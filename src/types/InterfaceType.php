<?php

namespace SRC\TYPES;

use SRC\ObjectArray;
use SRC\TypeQualifier;

interface InterfaceType
{
    public function insert(ObjectArray $Array, $value , $index = null): void;

    public function validation($value, $index, $type, $indexType, TypeQualifier $Qualifier): void;

    public function delete($index): void;

    public function getAsArray(): ?array;

    public function isEmpty(): ?bool;

    public function getFirstElement(): ?object;
}
