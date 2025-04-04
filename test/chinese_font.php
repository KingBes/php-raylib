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

// 读取字体文件
$fileData = Core::loadFileData(
    __DIR__ . DIRECTORY_SEPARATOR . "AlimamaFangYuanTiVF-Thin.ttf",
);

var_dump($fileData);

$text = "使用中文字体";

$codepoints = Text::loadCodepoints($text);

// $font = Text::loadFontFromMemory(".ttf", $fileData, 0, $codepoints);

// if (Text::isFontValid($font) == false) {
//     // 如果字体加载失败，抛出异常
//     throw new \Exception("无法加载系统字体，请检查路径是否正确！");
// }

// // 白色
// $white = Utils::color(255, 255, 255);

// $gray = Utils::color(200, 200, 200); // 灰色

// $textPosition  = Utils::vector2(0, 0); // 文本位置

// // 主循环
// while (!Core::windowShouldClose()) {
//     Core::beginDrawing(); //开始绘制
//     Core::clearBackground($white); //清楚背景色

//     Text::drawTextEx($font, $text, $textPosition, 24, 2, $gray); // 绘制提示文本

//     Core::endDrawing(); //结束绘制
// }

// Text::unloadFont($font); // 卸载字体

Core::closeWindow(); // 关闭窗口