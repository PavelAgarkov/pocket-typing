<?php

namespace SRC\TYPES;

use ArrayObject;
use SRC\ObjectArray;
use SRC\TypeQualifier;

class Vector extends Type
{

    public function __construct(ObjectArray $Array)
    {
        $Array->Array = new ArrayObject();

        $this->Object = &$Array->Array;
    }

    public function insert(ObjectArray $Array, $value , $index = null): void
    {
        $Array->Array->append($value);
    }

    public function validation($value, $index, $type, $indexType, TypeQualifier $Qualifier): void
    {
        if ($Qualifier->compareIndexType($index) === false) {
            throw new \Exception("Созданный массив не может записать индекс переданного типа {$indexType} так как объект создан для типа индекса {$Qualifier->indexType}");
        }
    }

    public function delete($index): void
    {

    }

    public function getAsArray(): ?array
    {
        return (array) $this->Object;
    }

    public function isEmpty(): ?bool
    {
        if($this->Object->count() > 0)
            return false;
        else return true;
    }

    public function getFirstElement(): ?object
    {
        return $this->Object->offsetGet(0);
    }
}