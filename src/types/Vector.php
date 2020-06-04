<?php

namespace src\types;

use ArrayObject;
use src\exceptions\ExceptionMessages;
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

    public function insert($value, $index = null): void
    {
        $this->Object->append($value);
    }

    public function validation($value, $index, $type, $indexType, TypeQualifier $Qualifier): void
    {
        if ($Qualifier->compareIndexType($index) === false) {
            throw new VectorKeyException(ExceptionMessages::parse(
                [$indexType, $Qualifier->indexType],
                ExceptionMessages::$message['common']['insertIndexType']
            ));
        }
    }

    public function delete($index): ?object
    {
        if ($type = gettype($index) == 'integer') {
            if ($this->offsetExist($index)) {
                $this->Object->offsetUnset($index);
                return $this;
            } else {
                throw new VectorKeyException(ExceptionMessages::$message['common']['indexExist']);
            }
        } else {
            throw new VectorKeyException(ExceptionMessages::parse(
                [$type],
                ExceptionMessages::$message['common']['deleteIndexType']
            ));
        }

    }

    public function getAsArray(): ?array
    {
        return (array)$this->Object;
    }

    public function isEmpty(): ?bool
    {
        if ($this->Object->count() > 0)
            return false;
        else return true;
    }

    public function getFirstElement(): ?object
    {
        return $this->Object->offsetGet(0);
    }

    public function offsetExist($index): ?bool
    {
        if ($type = gettype($index) == 'integer') {
            return $this->Object->offsetExists($index);
        } else {
            throw new VectorKeyException(ExceptionMessages::parse(
                [$type],
                ExceptionMessages::$message['common']['existIndexType']
            ));
        }
    }

    public function count(): ?int
    {
        return $this->Object->count();
    }

    public function valueByKey($key)
    {
        if ($type = gettype($key) == 'integer') {
            if ($this->offsetExist($key)) {
                return $this->Object->offsetGet($key);
            } else {
                throw new VectorKeyException(ExceptionMessages::$message['common']['indexExist']);
            }
        } else {
            throw new VectorKeyException(ExceptionMessages::parse(
                [$type],
                ExceptionMessages::$message['common']['existIndexType']
            ));
        }
    }
}