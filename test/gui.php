<?php

require dirname(__DIR__) . "/vendor/autoload.php";

use Kingbes\Raylib\Core; //核心
use Kingbes\Raylib\Utils; // 工具类
use Kingbes\Raylib\Gui;

Core::initWindow(800, 450, "Hello World"); //初始化窗口

Core::setTargetFPS(60); //设置目标帧率

// 白色
$white = Utils::color(255, 255, 255);

// 按钮位置大小
$recBtn = Utils::rectangle(24, 24, 120, 30);

// 消息盒子位置大小
$recMsgBox = Utils::rectangle(85, 70, 250, 100);

// 消息盒子开关
$showMsgBox = false;

// 主循环
while (!Core::windowShouldClose()) {
    Core::beginDrawing(); //开始绘制

    Core::clearBackground($white); // 清除背景

    // 按钮控件控件
    if (Gui::button($recBtn, "#191#Show Message")) { // 按钮被点击
        $showMsgBox = true;
    }

    if ($showMsgBox) { // 如果消息盒子被打开
        // 消息盒子控件
        $res = Gui::messageBox($recMsgBox, "Message Box", "This is a message box.", "Nice;Cool");
        if ($res >= 0) { // 如果用户点击了按钮
            // 根据用户点击的按钮，执行不同的操作
            echo "用户点击了按钮: $res\n";
            $showMsgBox = false;
        }
    }


    Core::endDrawing(); // 结束绘制
}

// 关闭窗口
Core::closeWindow();
