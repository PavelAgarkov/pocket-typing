<?php

namespace SRC\TYPES;

use SRC\TYPES\HashTable;
use SRC\TYPES\Type;
use SRC\TYPES\Vector;

class TypeFinder
{
    public string $type;

    public Type $Type;

    public function __construct(string $type)
    {
        $this->type = $type;

        switch ($this->type) {
            case 'integer' :
                $this->Type = new Vector();
                break;
            case 'string' :
                $this->Type = new HashTable();
                break;
        }

    }

    public function getArrType(): ?object
    {
        return $this->Type;
    }

}