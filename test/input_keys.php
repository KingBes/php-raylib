<?php

require dirname(__DIR__) . "/vendor/autoload.php";

use Kingbes\Raylib\Core;
use Kingbes\Raylib\Utils;
use Kingbes\Raylib\Text;
use Kingbes\Raylib\Shapes;

// 窗口大小
$screenWidth = 800;
$screenHight = 450;

// 初始化窗口
Core::initWindow($screenWidth, $screenHight, "input_keys");

// 设置目标FPS
Core::setTargetFPS(60);

// 球的位置
$ballPosition = Utils::vector2($screenWidth / 2, $screenHight / 2);

// 白色
$white = Utils::color(255, 255, 255);

// 绿色
$green = Utils::color(0, 255, 0);

// 红色
$red = Utils::color(255, 0, 0);

while (!Core::windowShouldClose()) {

    // 检测按键
    if (Core::isKeyDown(262)) {
        $ballPosition->x += 2.0;
    }
    if(Core::isKeyDown(263)){
        $ballPosition->x -= 2.0;
    }
    if(Core::isKeyDown(265)){
        $ballPosition->y -= 2.0;
    }
    if(Core::isKeyDown(264)){
        $ballPosition->y += 2.0;
    }

    // 开始绘制
    Core::beginDrawing();

    // 清空背景
    Core::clearBackground($white);

    // 文本
    Text::drawText("Move the ball with arrow keys!", 10, 10, 20, $green);

    // 画一个球
    Shapes::drawCircleV($ballPosition, 50, $red);

    // 结束绘制
    Core::endDrawing();
}

// 关闭窗口
Core::closeWindow();
