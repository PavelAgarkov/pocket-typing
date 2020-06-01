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
                $class = get_class($value);
                if ($this->Qualifier->getTypeObj($this) == $class) //если тип объекта массива равен типу передаваемого значения
                {
                    $this->Qualifier->Finder->getArrType()->insert($this, $value, $index);

                } else //если тип объекта массива не равен типу передаваемого значения то исключение
                {
                    throw new \Exception("Тип данных массива {$this->Qualifier->getTypeObj($this)} 
                не соответствует добавляемым {$class}");
                }

            } else if ($type != 'object' && !empty($this->array)) // если передаваемое значение не объект
            {
                if ($this->Qualifier->getTypeValue() == $type) //если тип передаваемого значения равен типу элемента массива
                {
                    $this->Qualifier->Finder->getArrType()->insert($this, $value, $index);
                }
            }

        } catch (\Exception $exception) {

            exit($exception->getMessage());
        }

        return $this;
    }
}