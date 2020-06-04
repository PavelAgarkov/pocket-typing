<?php

namespace src;

use src\types\TypeFinder;
use src\exceptions\QualifierConstructException;
use src\exceptions\QualifierInsertException;
use src\exceptions\ExceptionMessages;

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

    public function __construct(string $indexType, string $valueType, ObjectArray $Array)
    {
        //определяет какой тип массива используется
        $this->Finder = new TypeFinder($indexType, $Array);

        //проверка типа индекса из возможных
        if (in_array($indexType, static::TYPES_FOR_INDEX)) {
            $this->indexType = $indexType;
        } else {

            throw new QualifierConstructException(ExceptionMessages::parse(
                [$indexType],
                ExceptionMessages::$message['qualifier']['construct']['indexType']
            ));
        }

        //проверка типа значения из возможных
        if (in_array($valueType, static::TYPES_FOR_VALUE)) {
            $this->valueType = $valueType;
        } else if (in_array($valueType, static::TYPES_FOR_VALUE) && $indexType == 'object') {
            $this->valueType = $valueType;
            $this->objType = get_class($valueType);
        } else {

            throw new QualifierConstructException(ExceptionMessages::parse(
                [$valueType],
                ExceptionMessages::$message['qualifier']['construct']['valueType']
            ));
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
        $class = get_class($Array->Qualifier->Finder->getArrType()->getFirstElement());

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

    public function validationInsert($value, $index, $type, $indexType): void
    {
        if (!$this->compareValueType($value)) {
            throw new QualifierInsertException(ExceptionMessages::parse(
                [$type, $this->valueType],
                ExceptionMessages::$message['qualifier']['insert']['valueObjectType']
            ));
        }

        $this->Finder->getArrType()->validation($value, $index, $type, $indexType, $this);
    }

    public function insertInArrayObject(ObjectArray $Array, $value, $index): void
    {
        $class = get_class($value);

        if ($this->getTypeObj($Array) == $class) //если тип объекта массива равен типу передаваемого значения
        {
            $this->Finder->getArrType()->insert($value, $index);

        } else //если тип объекта массива не равен типу передаваемого значения то исключение
        {
            throw new QualifierInsertException(ExceptionMessages::parse(
                [$this->getTypeObj($Array), $class],
                ExceptionMessages::$message['qualifier']['insert']['valueInsertObjectType']
            ));
        }
    }

    public function insertInArrayOtherValues($value, $index, $type): void
    {
        if ($this->getTypeValue() == $type) //если тип передаваемого значения равен типу элемента массива
        {
            $this->Finder->getArrType()->insert($value, $index);
        }
    }

}