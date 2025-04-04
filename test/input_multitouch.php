<?php

// 多点触控输入 触屏

require dirname(__DIR__) . '/vendor/autoload.php';

use Kingbes\Raylib\Core; //核心
use Kingbes\Raylib\Text; // 文本
use Kingbes\Raylib\Utils; // 工具类
use Kingbes\Raylib\Shapes; // 图形

$screenWidth = 800; // 屏幕宽度
$screenHeight = 450; // 屏幕高度

Core::initWindow($screenWidth, $screenHeight, "input multitouch"); //初始化窗口

$touchPositions = []; // 存储触摸点位置的数组

// 白色
$white = Utils::color(255, 255, 255);

// 橙色
$orange = Utils::color(255, 127, 0);

// 黑色
$black = Utils::color(0, 0, 0);

$darkgray = Utils::color(80, 80, 80); // 深灰色

Core::setTargetFPS(60); //设置目标帧率

while (!Core::windowShouldClose()) {

    $tCount = Core::getTouchPointCount(); // 获取触摸点数量
    for ($i = 0; $i < $tCount; $i++) {
        $touchPositions[$i] = Core::getTouchPosition($i); // 获取每个触摸点的位置
    }

    Core::beginDrawing(); //开始绘制
    Core::clearBackground($white); //清楚背景色

    for ($i = 0; $i < $tCount; $i++) {
        if (($touchPositions[$i]->x > 0) && ($touchPositions[$i]->y > 0)) {
            // 绘制触摸点
            Shapes::drawCircleV($touchPositions[$i], 34, $orange); // 绘制圆圈
            Text::drawText("Touch point #$i", $touchPositions[$i]->x - 10, $touchPositions[$i]->y - 70, 40, $black); // 绘制文本
        }
    }
    // 绘制提示文本
    Text::drawText("touch the screen at multiple locations to get multiple balls", 10, 10, 20, $darkgray); // 绘制提示文本

    Core::endDrawing(); //结束绘制
}

Core::closeWindow(); // 关闭窗口