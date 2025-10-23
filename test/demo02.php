<?php

require dirname(__DIR__) . "/vendor/autoload.php";

use Kingbes\Raylib\Gui;

$icons = Gui::getIcons();
var_dump($icons);
