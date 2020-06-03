<?php

namespace src;

use src\handlers\ExceptionHandler;

class ObjectArray
{
    public TypeQualifier $Qualifier;

    public $Array;

    public ExceptionHandler $ExceptionHandler;

    public function __construct(string $indexType = "integer", string $valueType)
    {
        $this->Qualifier = new TypeQualifier($indexType, $valueType, $this);

        $this->ExceptionHandler = new ExceptionHandler();
    }

    public function insert($value = null, $index = null): ?object
    {
        if (is_null($value)) {
            return $this;
        }

        $type = gettype($value);
        $indexType = gettype($index);
        $this->Qualifier->validationInsert($value, $index, $type, $indexType);

        //проверка объектом на соответствие типа аргумента переданного в параметрах и типа массива
        if ($this->Qualifier->Finder->getArrType()->isEmpty()) //если массив пуст
        {
            $this->Qualifier->Finder->getArrType()->insert($this, $value, $index);
        } else if ($type == 'object' && !$this->Qualifier->Finder->getArrType()->isEmpty()) //если передаваемое значение объект и если массив не пуст
        {
            $this->Qualifier->insertInArrayObject($this, $value, $index);

        } else if ($type != 'object' && !$this->Qualifier->Finder->getArrType()->isEmpty()) // если передаваемое значение не объект
        {
            $this->Qualifier->insertInArrayOtherValues($this, $value, $index, $type);
        }
        return $this;
    }

    public function delete($index): void
    {
        $this->Qualifier->Finder->getArrType()->delete($index);
    }

    public function getAsAnArray(): ?array
    {
        return $this->Qualifier->Finder->getArrType()->getAsArray($this);
    }

    public function keyExist($index): ?bool
    {
        return $this->Qualifier->Finder->getArrType()->offsetExist($index);
    }
}