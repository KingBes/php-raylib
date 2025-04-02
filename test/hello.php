<?php

include __DIR__ . '/../vendor/autoload.php';

use Kingbes\Raylib\Core; //核心
use Kingbes\Raylib\Text; // 文本
use Kingbes\Raylib\Utils; // 工具类

Core::initWindow(800, 450, "Hello World"); //初始化窗口

Core::setTargetFPS(60); //设置目标帧率

// 白色
$white = Utils::Color(255, 255, 255);

// 绿色
$green = Utils::Color(0, 255, 0);

// 主循环
while (!Core::windowShouldClose()) {
    Core::beginDrawing(); //开始绘制

    Core::clearBackground($white); // 清除背景

    // 绘制文本
    Text::drawText("Hello World", 190, 200, 20, $green);

    Core::endDrawing(); // 结束绘制
}

// 关闭窗口
Core::closeWindow();
