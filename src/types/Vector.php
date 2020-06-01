<?php

namespace SRC\TYPES;

use SRC\ObjectArray;
use SRC\TypeQualifier;

class Vector extends Type
{
    public function insert(ObjectArray $Array, $value , $index = null): void
    {
        $Array->array[] = $value;
    }

    public function validation($value, $index, $type, $indexType, TypeQualifier $Qualifier)
    {
        if ($Qualifier->compareIndexType($index) === false) {
            throw new \Exception("Созданный массив не может записать индекс переданного типа {$indexType}
            так как объект создан для типа индекса {$Qualifier->indexType}");
        }
    }
}