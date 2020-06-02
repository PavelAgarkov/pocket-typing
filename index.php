<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use SRC\ObjectArray;

$obj = new ObjectArray("string", "object");

$arr1 = new ObjectArray("integer", "array");

$f = new \SRC\ASSOCIATE\AssociateArray();

//$arr->insert([1,23,4]);
//$arr->insert([1,23,4]);

$arr1->insert([1,23,4]);
$arr1->insert([1,23,5]);
$arr1->insert(1);

//$obj->insert($arr);
$obj->insert($f, 'w');
$obj->insert($f, 's');

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
print_r($arr1->Array);

// если передать два разным массива то они запишутся и ошибки не будет. нужна проверка по уровням и полям
