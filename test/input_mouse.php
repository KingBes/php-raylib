<?php

include __DIR__ . '/../vendor/autoload.php';

use Kingbes\Raylib\Core; //核心
use Kingbes\Raylib\Text; // 文本
use Kingbes\Raylib\Utils; // 工具类
use Kingbes\Raylib\Shapes; // 图形

Core::initWindow(800, 450, "input mouse"); //初始化窗口

Core::setTargetFPS(60); //设置目标帧率

// 白色
$white = Utils::Color(255, 255, 255);

// 绿色
$green = Utils::Color(0, 255, 0);

// 是否隐藏光标
$isCursorHidden  = 0;

$ballColor = Utils::Color(0, 255, 0); // 球的颜色

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

    $ballPosition = Core::getMousePosition(); // 获取鼠标位置

    if (Core::isMouseButtonPressed(0)) { // 左键按下
        $ballColor = Utils::Color(0, 0, 255); // 改变球的颜色
    }
    if (Core::isMouseButtonReleased(0)) { // 左键释放
        $ballColor = Utils::Color(255, 0, 0); // 恢复球的颜色
    }

    Core::beginDrawing(); //开始绘制
    Core::clearBackground($white); // 清除背景

    // 绘制球
    Shapes::drawCircleV($ballPosition, 50, $ballColor); // 绘制球

    // 绘制文本
    Text::drawText("Press 'H' to toggle cursor visibility", 10, 30, 20, $green);

    
    if ($isCursorHidden == 1) { // 如果光标被隐藏
        Text::drawText("Cursor is hidden", 10, 60, 20, $green);
    } else {
        Text::drawText("Cursor is visible", 10, 60, 20, $green);
    }

    Core::endDrawing(); // 结束绘制
}

// 关闭窗口
Core::closeWindow();
