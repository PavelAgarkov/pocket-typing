<?php

namespace src\types;

use ArrayObject;
use src\ObjectArray;
use src\TypeQualifier;
use src\exceptions\VectorKeyException;

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
            throw new VectorKeyException("Созданный массив не может записать индекс переданного типа {$indexType} так как объект создан для типа индекса {$Qualifier->indexType}");
        }
    }

    public function delete($index): ?object
    {
        if (gettype($index) == 'integer') {
            if($this->offsetExist($index)) {
                $this->Object->offsetUnset($index);
                return $this;
            } else {
                throw new VectorKeyException('В ключах массива нет переданного аргумента');
            }
        } else {
            throw new VectorKeyException('Для удаления по индексу необходимо использовать тип передаваемого значения integer');
        }

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

    public function offsetExist($index): ?bool
    {
        if (gettype($index) == 'integer') {
            return $this->Object->offsetExists($index);
        } else {
            throw new VectorKeyException('Для нахождения элемента по индексу необходимо использовать тип передаваемого значения integer');
        }
    }
}