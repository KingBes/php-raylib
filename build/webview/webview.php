<?php

require dirname(dirname(__DIR__)) . "/vendor/autoload.php";

use Kingbes\Raylib\Core;
use Kingbes\Raylib\Base;

use \FFI\CData;

class webview extends Base
{
    public static function create($debug = 0, &$window = null): CData
    {
        return self::ffi()->webview_create($debug, $window);
    }

    public static function n(CData $wb, string $url): int
    {
        return self::ffi()->webview_navigate($wb, $url);
    }

    public static function win(CData $wb): CData
    {
        return self::ffi()->webview_get_window($wb);
    }

    public static function run(CData $wb): int
    {
        return self::ffi()->webview_run($wb);
    }

    public static function terminate(CData $wb): int
    {
        return self::ffi()->webview_terminate($wb);
    }
}

// $webview = new webview();

Core::initWindow(800, 450, "Hello World"); //初始化窗口

$win = Core::getWindowHandle();

var_dump($win);

$wb = webview::create(0, $win);

$res = webview::n($wb, "http://www.baidu.com/");

webview::run($wb);

webview::terminate($wb);

// var_dump($res);

// var_dump($win == $webview->win($wb) ? true : false);

// Core::setTargetFPS(60); //设置目标帧率

// // Core::OpenURL("http://www.baidu.com/");

// // 主循环
// while (!Core::windowShouldClose()) {
//     Core::beginDrawing(); //开始绘制

//     // Core::enableEventWaiting();

//     Core::endDrawing(); // 结束绘制
// }

// // 关闭窗口
// Core::closeWindow();
