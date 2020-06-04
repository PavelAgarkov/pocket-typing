<?php

namespace src\exceptions;

class ExceptionMessages
{
    public static array $message = [

        'qualifier' => [

            'construct' => [
                'indexType'             => '!!  Type of index to create |*| does not match the possible !!',
                'valueType'             => '!!  Type of value to be created |*| not appropriate !!'
            ],

            'insert' => [
                'valueObjectType'       => '!!  The created array cannot write the passed value type |*| since an array object is created for type |*| !!',
                'valueInsertObjectType' => '!!  Array Object Data Type |*| does not match transferred |*|  !!'
            ]

        ],

        'vector' => [],

        'hashTable' => [],

        'common' => [
            'indexExist'                => '!!  Array keys have no argument passed  !!',
            'insertIndexType'           => '!!  The created array cannot write the index of the passed type |*| since the object was created for the index type |*| !!',
            'deleteIndexType'           => '!!  To delete by index, it is necessary to use the integer type of the transmitted value |*|  !!',
            'existIndexType'            => '!!  To find an element by index, you must use the type of the transmitted value |*| !!'
        ]

    ];

    public static function parse(array $args, string $exceptionName): ?string
    {
        $explodeString = explode(' ', $exceptionName);

        foreach ($explodeString as $key => $value) {

            if ($value == '|*|') {

                foreach ($args as $kArgs => $vArgs) {
                    $explodeString[$key] = $vArgs;
                    unset($args[$kArgs]);
                    break;
                }

            }
        }

        $implodeString = implode(' ', $explodeString);

        return $implodeString;
    }

}