<?php

// 鼠标滚轮输入

require dirname(__DIR__) . '/vendor/autoload.php';

use Kingbes\Raylib\Core; //核心
use Kingbes\Raylib\Text; // 文本
use Kingbes\Raylib\Utils; // 工具类
use Kingbes\Raylib\Shapes; // 图形

$screenWidth = 800; // 屏幕宽度
$screenHeight = 450; // 屏幕高度

Core::initWindow($screenWidth, $screenHeight, "input mouse wheel"); //初始化窗口

$boxPositionY = $screenHeight / 2 - 40; // 盒子初始位置

$scrollSpeed = 4; // 滚动速度

Core::setTargetFPS(60); //设置目标帧率

$white = Utils::Color(255, 255, 255); // 白色'

$green = Utils::Color(0, 255, 0); // 绿色

$gray = Utils::Color(200, 200, 200); // 灰色

$lightGray = Utils::Color(220, 220, 220); // 浅灰色

while (!Core::windowShouldClose()) {

    $boxPositionY -= Core::getMouseWheelMove() * $scrollSpeed; // 获取鼠标滚轮移动的值并更新盒子位置

    Core::beginDrawing(); //开始绘制
    Core::clearBackground($white); // 清除背景

    Shapes::drawRectangle($screenWidth / 2 - 40, $boxPositionY, 80, 80, $green); // 绘制盒子
    
    // 绘制文本
    Text::drawText("Use mouse wheel to move the cube up and down!", 10, 10, 20, $gray); 

    // 绘制鼠标滚轮移动的值
    Text::drawText("Box position Y: " . $boxPositionY, 10, 40, 20, $lightGray); 

    Core::endDrawing(); //结束绘制
}

Core::closeWindow(); // 关闭窗口