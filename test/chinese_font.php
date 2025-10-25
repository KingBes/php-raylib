<?php

// 中文字体

require dirname(__DIR__) . '/vendor/autoload.php';

use Kingbes\Raylib\Core; //核心
use Kingbes\Raylib\Text; // 文本
use Kingbes\Raylib\Utils; // 工具类

// 宽高
$screenWidth = 800;
$screenHeight = 450;

Core::initWindow($screenWidth, $screenHeight, "使用中文字体"); //初始化窗口

Core::setTargetFPS(60); //设置目标帧率

$font = Text::loadFontEx(
    __DIR__ . DIRECTORY_SEPARATOR . "AlimamaShuHeiTi-Bold.ttf",
    // __DIR__ . DIRECTORY_SEPARATOR . "seguiemj.ttf",
    64
);

$text = "你好，中文！asd"; // 中文文本


// 白色
$white = Utils::color(255, 255, 255);

$red = Utils::color(255, 0, 0); // 红色

$textPosition  = Utils::vector2(100, 100); // 文本位置

// 主循环
while (!Core::windowShouldClose()) {
    Core::beginDrawing(); //开始绘制
    Core::clearBackground($white); //清楚背景色

    Text::drawTextEx($font, $text, $textPosition, 16, 2, $red); // 绘制提示文本

    Core::endDrawing(); //结束绘制
}


Text::unloadFont($font); // 卸载字体

Core::closeWindow(); // 关闭窗口