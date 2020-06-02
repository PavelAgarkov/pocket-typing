<?php

namespace SRC\TYPES;

use SRC\ASSOCIATE\AssociateArray;
use SRC\ObjectArray;
use SRC\TypeQualifier;

class HashTable extends Type
{
    public function __construct(ObjectArray $Array)
    {
        $Array->Array = new AssociateArray();

        $this->Object = &$Array->Array;
    }

    public function insert(ObjectArray $Array, $value, $index = null): void
    {
        $Array->Array->add($index, $value);
    }

    public function validation($value, $index, $type, $indexType, TypeQualifier $Qualifier): void
    {
        if ($Qualifier->compareIndexType($index) === false || is_null($Qualifier->compareIndexType($index))) {
            throw new \Exception("Созданный массив не может записать индекс переданного типа {$indexType} так как объект создан для типа индекса {$Qualifier->indexType}");
        }
    }

    public function delete($index): void
    {

    }

    public function getAsArray(): ?array
    {
        return $this->Object->getArray();
    }

    public function isEmpty(): ?bool
    {
        if ($this->Object->getCountElements() > 0)
            return false;
        else return true;
    }

    public function getFirstElement(): ?object
    {
        return $this->Object->getFirst();
    }
}