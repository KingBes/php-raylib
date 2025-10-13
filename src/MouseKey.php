<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib;

/**
 * 鼠标按钮
 * 
 * @property int Left 左键 0
 * @property int Right 右键 1
 * @property int Middle 中键（按下滚轮） 2
 * @property int Side 鼠标侧键（高级鼠标设备） 3 
 * @property int Extra 鼠标额外键（高级鼠标设备） 4
 * @property int Forward 鼠标前进键（高级鼠标设备） 5
 * @property int Back 鼠标后退键（高级鼠标设备） 6
 */
enum MouseKey: int
{
    case Left = 0;
    case Right = 1;
    case Middle = 2;
    case Side = 3;
    case Extra = 4;
    case Forward = 5;
    case Back = 6;
}
