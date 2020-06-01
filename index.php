<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use SRC\ObjectArray;

$obj = new ObjectArray("integer", "object");

//$obj = new ObjectArray("integer", "object");

//$obj = new ObjectArray("integer", "string");

//$obj = new ObjectArray("string", "string");

$arr = new ObjectArray("integer", "integer");

$f = new ArrayObject();

$obj->insert($f);
$obj->insert($f);

//$obj->insert($f);
//$obj->insert($f);

//$obj->insert("fd");
//$obj->insert("3f");

//$obj->insert("3f", 'e3');
//$obj->insert("3f", 'e4');
var_dump($obj->array);

// если передать два разным массива то они запишутся и ошибки не будет. нужна проверка по уровням и полям
