<?php

namespace SRC;

use SRC\TYPES\TypeFinder;
use SRC\TYPES\Vector;

class TypeQualifier
{
    const TYPES_FOR_INDEX = [
        "integer",
        "string"
    ];

    const TYPES_FOR_VALUE = [
        "boolean",
        "integer",
        "double",
        "string",
        "array",
        "object"
    ];

    public string $valueType = '';

    public string $indexType = '';

    public string $objType = '';

    public TypeFinder $Finder;

    public function __construct(string $indexType, string $valueType)
    {
        try {
            //определяет какой тип массива используется
            $this->Finder = new TypeFinder($indexType);

            //проверка типа индекса из возможных
            if (in_array($indexType, static::TYPES_FOR_INDEX)) {
                $this->indexType = $indexType;
            } else {
                throw new \Exception("Тип индекса {$indexType} не соответствует возможным");
            }

            //проверка типа значения из возможных
            if (in_array($valueType, static::TYPES_FOR_VALUE)) {
                $this->valueType = $valueType;
            } else if (in_array($valueType, static::TYPES_FOR_VALUE) && $indexType == 'object') {
                $this->valueType = $valueType;
                $this->objType = get_class($valueType);
            } else {
                throw new \Exception("Тип значения {$valueType} не соответствует возможным");
            }

        } catch (\Exception $exception) {
            exit($exception->getMessage());
        }
    }

    public function getTypeIndex(): ?string
    {
        return $this->indexType;
    }

    public function getTypeValue(): ?string
    {
        return $this->valueType;
    }

    public function getTypeObj(ObjectArray $Array): ?string
    {
        $class = null;
        if (!empty($Array->array)) {
            $class = get_class(current($Array->array));
        }
        return $class;

    }

    public function compareValueType($value): ?bool
    {
        if (gettype($value) == $this->getTypeValue()) {
            return true;
        } else return false;
    }

    public function compareIndexType($index): ?bool
    {
        if (is_null($index)) {
            return null;
        }

        if (gettype($index) == $this->getTypeIndex()) {
            return true;
        } else return false;
    }

    public function validation($value, $index, $type, $indexType): void
    {
        if (!$this->compareValueType($value)) {
            throw new \Exception("Созданный массив не может записать переданный тип {$type} так как объект создан для типа {$this->valueType}");
        }

        $this->Finder->getArrType()->validation($value, $index, $type, $indexType, $this);
    }

    public function insertInArrayObject(ObjectArray $Array, $value, $index): void
    {
        $class = get_class($value);

        if ($this->getTypeObj($Array) == $class) //если тип объекта массива равен типу передаваемого значения
        {
            $this->Finder->getArrType()->insert($Array, $value, $index);

        } else //если тип объекта массива не равен типу передаваемого значения то исключение
        {
            throw new \Exception("Тип данных массива {$this->getTypeObj($Array)} не соответствует добавляемым {$class}");
        }
    }

    public function insertInArrayOtherValues(ObjectArray $Array, $value, $index, $type): void
    {
        if ($this->getTypeValue() == $type) //если тип передаваемого значения равен типу элемента массива
        {
            $this->Finder->getArrType()->insert($Array, $value, $index);
        }

    }
}