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

$dropdownBox = false;
$dropdownBoxIndex = 0;

$spinnerValue = 0;
$spinnerEditMode = true;

$text = "Hello World";
$textBoxEditMode = false;

$mouseCell = Utils::vector2(0, 0);

// 列表视图滚动索引
$listViewScrollIndex = 0;
// 列表视图活动索引
$listViewActive = 0;
// 列表视图焦点索引
$listViewFocus = 0;
// 列表视图文本
$listViewText = [
    "Charmander",
    "Bulbasaur",
    "#18#Squirtel",
    "Pikachu",
    "Eevee",
    "Pidgey"
];

$secretViewActive = false;

// 主循环
while (!Core::windowShouldClose()) {
    Core::beginDrawing(); //开始绘制

    Core::clearBackground($white); // 清除背景

    // // 按钮控件控件
    // if (Gui::button($recBtn, "#191#Show Message")) { // 按钮被点击
    //     $showMsgBox = true;
    // }

    // if ($showMsgBox) { // 如果消息盒子被打开
    //     // 消息盒子控件
    //     $res = Gui::messageBox($recMsgBox, "Message Box", "This is a message box.", "Nice;Cool");
    //     if ($res >= 0) { // 如果用户点击了按钮
    //         // 根据用户点击的按钮，执行不同的操作
    //         echo "用户点击了按钮: $res\n";
    //         $showMsgBox = false;
    //     }
    // }

    /* $tab = Gui::dropdownBox(
        Utils::rectangle(24, 120, 250, 30),
        "Tab 1;Tab 2",
        $dropdownBoxIndex,
        $dropdownBox
    );
    if ($tab) {
        $dropdownBox = !$dropdownBox;
    } */

    /* $spinner = Gui::spinner(
        Utils::rectangle(100, 120, 250, 30),
        "",
        $spinnerValue,
        0,
        100,
        $spinnerEditMode
    );
    if ($spinner) {
        $spinnerEditMode = !$spinnerEditMode;
    } */

    // 文本框控件
    /* $res = Gui::textBox(
        Utils::rectangle(24, 120, 250, 30),
        $text,
        20,
        $textBoxEditMode
    );
    if ($res) {
        $textBoxEditMode = !$textBoxEditMode;
        echo "文本框内容: $text\n";
    } */

    // 网格控件
    /* Gui::grid(
        Utils::rectangle(24, 120, 250, 250),
        "Grid",
        50,
        5,
        $mouseCell
    );
    var_dump($mouseCell); */

    // 列表视图控件
    /* Gui::listView(
        Utils::rectangle(24, 120, 250, 250),
        "Charmander;Bulbasaur;#18#Squirtel;Pikachu;Eevee;Pidgey",
        $listViewScrollIndex,
        $listViewActive
    ); */
    /* Gui::listViewEx(
        Utils::rectangle(24, 120, 250, 250),
        $listViewText,
        $listViewScrollIndex,
        $listViewActive,
        $listViewFocus
    ); */

    // 文本输入框控件
    $res = Gui::textInputBox(
        Utils::rectangle(24, 120, 250, 30),
        "Text Input Box",
        "Enter your password:",
        "Ok;Cancel",
        $text,
        20,
        $secretViewActive
    );
    if ($res) {
        echo "文本输入框内容: $text\n";
    }

    Core::endDrawing(); // 结束绘制
}

// 关闭窗口
Core::closeWindow();
