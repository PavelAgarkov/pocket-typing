<?php

namespace src\types;

use src\associate\AssociateArray;
use src\exceptions\AssociateArrayKeyException;
use src\ObjectArray;
use src\TypeQualifier;

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
            throw new AssociateArrayKeyException("Созданный массив не может записать индекс переданного типа {$indexType} так как объект создан для типа индекса {$Qualifier->indexType}");
        }
    }

    public function delete($index): ?object
    {
        if(gettype($index) == 'string') {
            $this->Object->offsetUnset($index);
            return $this;
        } else {
            throw new AssociateArrayKeyException('Для удаления по индексу необходимо использовать тип передаваемого значения string');
        }

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

    public function offsetExist($index): ?bool
    {
        if(gettype($index) == 'string') {
            return $this->Object->offsetExists($index);
        } else {
            throw new AssociateArrayKeyException('Для нахождения элемента по индексу необходимо использовать тип передаваемого значения string');
        }
    }
}