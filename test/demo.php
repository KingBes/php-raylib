<?php

require dirname(__DIR__) . '/vendor/autoload.php';

use Kingbes\Raylib\Utils\Color;


$color = new Color();
$color->r = 10;

echo $color->r . "\n";
var_dump($color->ptr());
