<?php

namespace SRC;

class ObjectArray
{
    public TypeQualifier $Qualifier;

    public $Array;

    public function __construct(string $indexType = "integer", string $valueType)
    {
        $this->Qualifier = new TypeQualifier($indexType, $valueType, $this);
    }

    public function insert($value = null, $index = null): ?object
    {
        if(is_null($value))
        {
            return $this;
        }

        try {
            $type = gettype($value);
            $indexType = gettype($index);
            $this->Qualifier->validation($value, $index, $type, $indexType);

            //проверка объектом на соответствие типа аргумента переданного в параметрах и типа массива
            if ($this->Qualifier->Finder->getArrType()->isEmpty()) //если массив пуст
            {
                $this->Qualifier->Finder->getArrType()->insert($this, $value, $index);
            }
            else if ($type == 'object' && !$this->Qualifier->Finder->getArrType()->isEmpty()) //если передаваемое значение объект и если массив не пуст
            {
                $this->Qualifier->insertInArrayObject($this, $value, $index);

            } else if ($type != 'object' && !$this->Qualifier->Finder->getArrType()->isEmpty()) // если передаваемое значение не объект
            {
                $this->Qualifier->insertInArrayOtherValues($this, $value, $index, $type);
            }

        } catch (\Exception $exception) {

            exit($exception->getMessage() . PHP_EOL . $exception->getFile() . " in line:" . $exception->getLine() . PHP_EOL . $exception->getTraceAsString());
        }

        return $this;
    }

    public function delete($index): void
    {
        $this->Qualifier->Finder->getArrType()->delete($index);
    }

    public function getAsAnArray(): ?array
    {
        return $this->Qualifier->Finder->Type->getAsArray($this);
    }
}