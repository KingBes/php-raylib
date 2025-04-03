<?php

require dirname(__DIR__) . "/vendor/autoload.php";

use Kingbes\Raylib\Core;
use Kingbes\Raylib\Utils;
use Kingbes\Raylib\Text;
use Kingbes\Raylib\Texture;

// 窗口大小
$screenWidth = 800;
$screenHight = 450;

// 初始化窗口
Core::initWindow($screenWidth, $screenHight, "input_keys");

// 设置目标FPS
Core::setTargetFPS(60);

// 球的位置
$ballPosition = Utils::Vector2($screenWidth / 2, $screenHight / 2);


// 白色
$white = Utils::Color(255, 255, 255);

// 绿色
$green = Utils::Color(0, 255, 0);

// 红色
$red = Utils::Color(255, 0, 0);

// 图
$image = Texture::genImageColor(100, 100, $red);

// 加载
// $img = Texture::loadImageColors($image);

while (!Core::windowShouldClose()) {

    // 开始绘制
    Core::beginDrawing();

    // 清空背景
    Core::clearBackground($white);
    
    // 文本
    Text::drawText("Move the ball with arrow keys!", 10, 10, 20, $green);

    // Texture::drawTextureV($image, $ballPosition, $red);

    // 结束绘制
    Core::endDrawing();
}

// 关闭窗口
Core::closeWindow();
