<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use src\ObjectArray;
use src\associate\AssociateArray;

$obj = new ObjectArray("integer", "object");

$arr1 = new ObjectArray("string", "array");

$bool = new ObjectArray('integer', 'boolean');

$bool->insert(true);

print_r($bool->Array);

$f = new AssociateArray();

$arr1->insert([1,23,4], "s1");
$arr1->insert([1,23,5], 's2');
$arr1->insert([1,23,5], 's3');

//$obj->insert($arr);
$obj->insert($f);
$obj->insert($f);
$obj->insert($f);


//валидация для удаления и проверки на ключ
//$arr1->delete(1);
//$obj->delete("string");

//$a = $arr1->keyExist(1);
//$b = $obj->keyExist('s5');
//var_dump($a, $b);

//$array = $obj->getAsAnArray();
//$array1 = $arr1->getAsAnArray();

//$a = $obj->count();
//$b = $arr1->count();

//$a = $obj->getValueByKey(6);
//$b = $arr1->getValueByKey('s2');
//var_dump($a, $b);


//$obj->insert($f);
//$obj->insert($f);



//$obj->insert($f);
//$obj->insert($f);

//$obj->insert("fd");
//$obj->insert("3f");

//$obj->insert("3f", 'e3');
//$obj->insert("3f", 'e4');
//print_r($arr1->Array);
//print_r($obj->Array);

// если передать два разным массива то они запишутся и ошибки не будет. нужна проверка по уровням и полям
