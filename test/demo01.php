<?php

require dirname(__DIR__) . '/vendor/autoload.php';

use Kingbes\Raylib\Math;

$value = 10.5;
$min = 0.0;
$max = 10.0;

$clampedValue = Math::clamp($value, $min, $max);
echo "Clamped value: $clampedValue\n";
