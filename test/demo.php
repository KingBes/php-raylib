<?php

require dirname(__DIR__) . '/vendor/autoload.php';

use Kingbes\Raylib\Utils\Color;


$color = new Color();
$color->r = 10;

/* echo $color->r . "\n";
var_dump($color->ptr()); */


class Demo
{
    public int $a = 0;
}


$demo = new Demo();
$demo->a = 10;

$demo2 = (object)["a" => 10];

var_dump($demo, $demo2);
