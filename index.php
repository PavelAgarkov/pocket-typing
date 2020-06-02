<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use SRC\ObjectArray;

$obj = new ObjectArray("integer", "object");

$arr1 = new ObjectArray("string", "array");

$f = new \SRC\ASSOCIATE\AssociateArray();

$arr1->insert([1,23,4], 's1');
$arr1->insert([1,23,5], 's2');
$arr1->insert([1,23,5], 's3');

//$obj->insert($arr);
$obj->insert($f);
$obj->insert($f);
$obj->insert($f);

$array = $obj->getAsAnArray();
$array1 = $arr1->getAsAnArray();

//$obj->insert($f);
//$obj->insert($f);



//$obj->insert($f);
//$obj->insert($f);

//$obj->insert("fd");
//$obj->insert("3f");

//$obj->insert("3f", 'e3');
//$obj->insert("3f", 'e4');
print_r($obj->Array);

// если передать два разным массива то они запишутся и ошибки не будет. нужна проверка по уровням и полям
