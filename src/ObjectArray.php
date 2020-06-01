<?php

namespace SRC;

class ObjectArray
{
    public $error = null;

    public TypeQualifier $Qualifier;

    public array $array = [];

    public function __construct(string $indexType = "integer", string $valueType)
    {
        $this->Qualifier = new TypeQualifier($indexType, $valueType);
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
            if (empty($this->array)) //если массив пуст
            {
                $this->Qualifier->Finder->getArrType()->insert($this, $value, $index);
            }
            else if ($type == 'object' && !empty($this->array)) //если передаваемое значение объект и если массив не пуст
            {
                $this->Qualifier->insertInArrayObject($this, $value, $index);

            } else if ($type != 'object' && !empty($this->array)) // если передаваемое значение не объект
            {
                $this->Qualifier->insertInArrayOtherValues($this, $value, $index, $type);
            }

        } catch (\Exception $exception) {

            exit($exception->getMessage());
        }

        return $this;
    }
}