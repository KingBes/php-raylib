<?php

// 设置窗口图标

require dirname(__DIR__) . '/vendor/autoload.php';

use Kingbes\Raylib\Core; //核心
use Kingbes\Raylib\Utils; // 工具类
use Kingbes\Raylib\Textures; // 纹理

// 宽高
$screenWidth = 800;
$screenHeight = 450;

Core::initWindow($screenWidth, $screenHeight, "设置窗口图标"); //初始化窗口

Core::setTargetFPS(60); //设置目标帧率

$icon = Textures::loadImage(__DIR__ . DIRECTORY_SEPARATOR . "php.png"); // 加载图标

Core::setWindowIcon($icon); // 设置窗口图标

Textures::unloadImage($icon); // 释放图标

// 白色
$white = Utils::color(255, 255, 255);

// 主循环
while (!Core::windowShouldClose()) {
    Core::beginDrawing(); //开始绘制
    Core::clearBackground($white); //清楚背景色

    Core::endDrawing(); //结束绘制
}
Core::closeWindow(); //关闭窗口