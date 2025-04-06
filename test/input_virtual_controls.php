<?php

// 输入虚拟控件

require dirname(__DIR__) . '/vendor/autoload.php';

use Kingbes\Raylib\Core; //核心
use Kingbes\Raylib\Text; // 文本
use Kingbes\Raylib\Utils; // 工具类

// 宽高
$screenWidth = 800;
$screenHeight = 450;

Core::initWindow($screenWidth, $screenHeight, "使用输入虚拟控件"); //初始化窗口

$padPosition = Utils::vector2(100, 350); // 虚拟控制器位置