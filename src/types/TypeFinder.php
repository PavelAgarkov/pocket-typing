<?php

namespace src\types;

use src\ObjectArray;
use src\types\HashTable;
use src\types\Type;
use src\types\Vector;

class TypeFinder
{
    public string $type;

    public Type $Type;

    public function __construct(string $type, ObjectArray $Array)
    {
        $this->type = $type;

        switch ($this->type) {
            case 'integer' :
                $this->Type = new Vector($Array);
                break;
            case 'string' :
                $this->Type = new HashTable($Array);
                break;
        }

    }

    public function getArrType(): ?object
    {
        return $this->Type;
    }

}