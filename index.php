<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use SRC\ObjectArray;

$obj = new ObjectArray("string", "integer");

//$arr = new ObjectArray("integer", "integer");

$f = new ArrayObject();

$obj->insert(1.2, 's1');
$obj->insert(3, 's2');
var_dump($obj);


//$obj->append(1, 'sf');
//$obj->append(1, "sg1");
//$obj->append(1, "sg2");
//$obj->append(1, "sg3");
//$obj->append(1, "sg4");
//$obj->append(1);
//$obj->append(1);
//$obj->append("12");

// если передать два разным массива то они запишутся и ошибки не будет. нужна проверка по уровням и полям
//var_dump($obj);