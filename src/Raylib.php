<?php

// 严格模式
declare(strict_types=1);

class Raylib
{
    private \FFI $ffi;

    public function __construct()
    {
        $lib_header = file_get_contents(__DIR__ . '/Raylib.h');
        $lib_file = dirname(__DIR__) . '/build/lib/windows/raylib.dll';
        $this->ffi = \FFI::cdef($lib_header, $lib_file);
    }

    public function initWindow(int $width, int $height, string $title): void
    {
        $this->ffi->InitWindow($width, $height, $title);
    }

    public function closeWindow(): void
    {
        $this->ffi->CloseWindow();
    }

    public function windowShouldClose(): bool
    {
        return $this->ffi->WindowShouldClose();
    }

    public function beginDrawing(): void
    {
        $this->ffi->BeginDrawing();
    }

    public function toggleBorderlessWindowed(): void
    {
        $this->ffi->ToggleBorderlessWindowed();
    }

    public function endDrawing(): void
    {
        $this->ffi->EndDrawing();
    }

    public function Color(int $r, int $g, int $b, int $a): \FFI\CData
    {
        $color = $this->ffi->new('Color');
        $color->r = $r;
        $color->g = $g;
        $color->b = $b;
        $color->a = $a;
        return $color;
    }


    public function drawText(string $text, int $x, int $y, int $size, \FFI\CData $color): void
    {
        $this->ffi->DrawText($text, $x, $y, $size, $color);
    }
}

// 实例化
$raylib = new Raylib();
// 定义颜色
$color = $raylib->Color(80, 80, 80, 255);
// 初始化窗口
$raylib->initWindow(800, 600, 'Hello World');

// 主循环
while (!$raylib->windowShouldClose()) {
    // 绘制
    $raylib->beginDrawing();
    // 定义文本
    $raylib->drawText('Hello World', 100, 100, 20, $color);
    // 结束绘制
    $raylib->endDrawing();
}
// 关闭窗口
$raylib->closeWindow();
