<?php

namespace src\exceptions;

class ExceptionMessages
{
    public static array $message = [

        'qualifier' => [

            'construct' => [
                'indexType'             => 'Тип создаваемого индекса |*| не соответствует возможному',
                'valueType'             => 'Тип создаваемого значения |*| не соответствует возможныму'
            ],

            'insert' => [
                'valueObjectType'       => "Созданный массив не может записать переданный тип значения |*| так как объект массива создан для типа |*|",
                'valueInsertObjectType' => "Тип данных объекта массива |*| не соответствует переданным |*|"
            ]
        ],

        'vector' => [],

        'hashTable' => [],

        'common' => [
            'indexExist'                => 'В ключах массива нет переданного аргумента',
            'insertIndexType'           => 'Созданный массив не может записать индекс переданного типа |*| так как объект создан для типа индекса |*|',
            'deleteIndexType'           => 'Для удаления по индексу необходимо использовать тип integer передаваемого значения, используется |*|',
            'existIndexType'            => 'Для нахождения элемента по индексу необходимо использовать тип передаваемого значения |*|'
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