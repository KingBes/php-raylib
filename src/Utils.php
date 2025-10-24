<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib;

use Kingbes\Raylib\Utils\Color;
use Kingbes\Raylib\Utils\Vector2;
use Kingbes\Raylib\Utils\Vector3;
use Kingbes\Raylib\Utils\Vector4;
use Kingbes\Raylib\Utils\Matrix;
use Kingbes\Raylib\Utils\Rectangle;

/**
 * Utils类
 */
class Utils extends Base
{
    // 角度转弧度
    public const DEG2RAD = 3.14159265358979323846 / 180.0;

    // 弧度转角度
    public const RAD2DEG = 180.0 / 3.14159265358979323846;

    /**
     * 颜色对象
     *
     * @param integer $r red 0-255
     * @param integer $g green 0-255
     * @param integer $b blue 0-255
     * @param integer $a alpha 0-255
     * @return Color
     */
    public static function color(int $r, int $g, int $b, int $a = 255): Color
    {
        return new Color($r, $g, $b, $a);
    }

    /**
     * 矩形对象2
     *
     * @param float $x x坐标
     * @param float $y y坐标
     * @return Vector2
     */
    public static function vector2(float $x, float $y): Vector2
    {
        return new Vector2($x, $y);
    }

    /**
     * 矩形对象3
     *
     * @param float $x x坐标
     * @param float $y y坐标
     * @param float $z z坐标
     * @return Vector3
     */
    public static function vector3(float $x, float $y, float $z): Vector3
    {
        return new Vector3($x, $y, $z);
    }

    /**
     * 矩形对象4
     *
     * @param float $x x坐标
     * @param float $y y坐标
     * @param float $z z坐标
     * @param float $w w坐标
     * @return Vector4
     */
    public static function vector4(float $x, float $y, float $z, float $w): Vector4
    {
        return new Vector4($x, $y, $z, $w);
    }

    /**
     * 矩形对象 4x4组件
     * 
     * @param array<float> $firstRow 第一行 4 个元素
     * @param array<float> $secondRow 第二行 4 个元素
     * @param array<float> $thirdRow 第三行 4 个元素
     * @param array<float> $fourthRow 第四行 4 个元素
     * @return Matrix
     */
    public static function matrix(
        array $firstRow,
        array $secondRow,
        array $thirdRow,
        array $fourthRow
    ): Matrix {
        return new Matrix(
            $firstRow,
            $secondRow,
            $thirdRow,
            $fourthRow
        );
    }

    /**
     * 矩形对象
     *
     * @param float $x x坐标
     * @param float $y y坐标
     * @param float $width 宽度
     * @param float $height 高度
     * @return Rectangle
     */
    public static function rectangle(float $x, float $y, float $width, float $height): Rectangle
    {
        return new Rectangle($x, $y, $width, $height);
    }
}
       