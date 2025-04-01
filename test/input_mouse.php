<?php

include __DIR__ . '/../vendor/autoload.php';

use Kingbes\Raylib\Core; //核心
use Kingbes\Raylib\Text; // 文本
use Kingbes\Raylib\utils; // 工具类

Core::initWindow(800, 450, "input mouse"); //初始化窗口

Core::setTargetFPS(60); //设置目标帧率

// 白色
$white = utils::Color(255, 255, 255);

// 绿色
$green = utils::Color(0, 255, 0);

// 是否隐藏光标
$isCursorHidden  = 0;

// 主循环
while (!Core::windowShouldClose()) {

    if (Core::isKeyPressed(72)) { // H 键
        if ($isCursorHidden == 0) {
            Core::hideCursor(); // 隐藏光标
            $isCursorHidden = 1;
        } else {
            Core::showCursor(); // 显示光标
            $isCursorHidden = 0;
        }
    }

    Core::beginDrawing(); //开始绘制
    Core::clearBackground($white); // 清除背景

    // 绘制文本
    Text::drawText("按“H”来切换光标的可见性", 10, 30, 20, $green);

    Core::endDrawing(); // 结束绘制
}

// 关闭窗口
Core::closeWindow();
