# php-raylib

🔥 PHP-FFI 绑 定 raylib-v5.5，实 现 享 受 视 频 游 戏 编 程。

[![php-raylib](https://apiv1.oschina.net/MjAyMi8xLzE2/gtags/v1/action/shard?type=1&id=75836)](https://www.oschina.net/p/php-raylib)

`可能完善度不高，欢迎 PR。`

[文档](http://raylib.kllxs.top/)

## 依赖

- PHP 7.4+
- FFI 扩展
- windows
- linux
- macos

## 安装

```bash
composer require kingbes/raylib
```

## 示例

```php
<?php

require dirname(__DIR__) . "/vendor/autoload.php";

use Kingbes\Raylib\Core; //核心
use Kingbes\Raylib\Text; // 文本
use Kingbes\Raylib\Utils; // 工具类

Core::initWindow(800, 450, "Hello World"); //初始化窗口

Core::setTargetFPS(60); //设置目标帧率

// 白色
$white = Utils::color(255, 255, 255);

// 绿色
$green = Utils::color(0, 255, 0);

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

```
