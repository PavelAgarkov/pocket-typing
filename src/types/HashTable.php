<?php

namespace src\types;

use src\associate\AssociateArray;
use src\exceptions\AssociateArrayKeyException;
use src\exceptions\ExceptionMessages;
use src\ObjectArray;
use src\TypeQualifier;

class HashTable extends Type
{
    public function __construct(ObjectArray $Array)
    {
        $Array->Array = new AssociateArray();

        $this->Object = &$Array->Array;
    }

    public function insert($value, $index = null): void
    {
        $this->Object->add($value, $index);
    }

    public function validation($value, $index, $type, $indexType, TypeQualifier $Qualifier): void
    {
        if ($Qualifier->compareIndexType($index) === false || is_null($Qualifier->compareIndexType($index))) {
            throw new AssociateArrayKeyException(ExceptionMessages::parse(
                [$indexType, $Qualifier->indexType],
                ExceptionMessages::$message['common']['insertIndexType']
            ));
        }
    }

    public function delete($index): ?object
    {
        if ($type = gettype($index) == 'string') {
            $this->Object->offsetUnset($index);
            return $this;
        } else {
            throw new AssociateArrayKeyException(ExceptionMessages::parse(
                [$type],
                ExceptionMessages::$message['common']['deleteIndexType']
            ));
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
        if ($type = gettype($index) == 'string') {
            return $this->Object->offsetExists($index);
        } else {
            throw new AssociateArrayKeyException(ExceptionMessages::parse(
                [$type],
                ExceptionMessages::$message['common']['existIndexType']
            ));
        }
    }

    public function count(): ?int
    {
        return $this->Object->getCountElements();
    }

    public function valueByKey($key)
    {
        if ($type = gettype($key) == 'string') {
            return $this->Object->valueByKey($key);
        } else {
            throw new AssociateArrayKeyException(ExceptionMessages::parse(
                [$type],
                ExceptionMessages::$message['common']['existIndexType']
            ));
        }
    }

}