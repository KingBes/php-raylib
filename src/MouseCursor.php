<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib;

/**
 * 鼠标光标
 * 
 * @property int Default 默认光标（箭头） 0
 * @property int Arrow 箭头光标 1
 * @property int Text 文本输入光标 2
 * @property int Crosshair 十字光标 3
 * @property int PointingHand 指向手光标 4
 * @property int ResizeHorizontal 水平调整大小光标 5
 * @property int ResizeVertical 垂直调整大小光标 6
 * @property int DiagonalArrow 左上到右下对角线调整箭头形状 7
 * @property int DiagonalArrowReverse 右上到左下对角线调整箭头形状 8
 * @property int ResizeAll 全方向调整箭头形状 9
 * @property int NotAllowed 操作不允许形状 10
 */
enum MouseCursor: int
{
    case Default = 0;
    case Arrow = 1;
    case Text = 2;
    case Crosshair = 3;
    case PointingHand = 4;
    case ResizeHorizontal = 5;
    case ResizeVertical = 6;
    case DiagonalArrow = 7;
    case DiagonalArrowReverse = 8;
    case ResizeAll = 9;
    case NotAllowed = 10;
}