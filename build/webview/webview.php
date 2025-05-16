<?php

require dirname(dirname(__DIR__)) . "/vendor/autoload.php";

use Kingbes\Raylib\Core;

use \FFI\CData;

class webview
{

    private \FFI $ffi;

    public function __construct()
    {
        $h = <<<CLANG
typedef void *webview_t;
webview_t webview_create(int debug, void *window);
int webview_navigate(webview_t w, const char *url);
void *webview_get_window(webview_t w);
int webview_run(webview_t w);
int webview_terminate(webview_t w);
CLANG;
        $this->ffi = \FFI::cdef(
            $h,
            __DIR__ . "/webview.dll"
        );
    }

    public function create($debug = 0, &$window = null): CData
    {
        return $this->ffi->webview_create($debug, $window);
    }

    public function n(CData $wb, string $url): int
    {
        return $this->ffi->webview_navigate($wb, $url);
    }

    public function win(CData $wb): CData
    {
        return $this->ffi->webview_get_window($wb);
    }

    public function run(CData $wb): int
    {
        return $this->ffi->webview_run($wb);
    }

    public function terminate(CData $wb): int
    {
        return $this->ffi->webview_terminate($wb);
    }
}

$webview = new webview();

Core::initWindow(800, 450, "Hello World"); //初始化窗口

$win = Core::getWindowHandle();

$wb = $webview->create(0, $win);

$res = $webview->n($wb, "http://www.baidu.com/");

/* $webview->run($wb);

$webview->terminate($wb); */

var_dump($res);

var_dump($win == $webview->win($wb) ? true : false);

Core::setTargetFPS(60); //设置目标帧率

// Core::OpenURL("http://www.baidu.com/");

// 主循环
while (!Core::windowShouldClose()) {
    Core::beginDrawing(); //开始绘制
    
    // Core::enableEventWaiting();

    Core::endDrawing(); // 结束绘制
}

// 关闭窗口
Core::closeWindow();
