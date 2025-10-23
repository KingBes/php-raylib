<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib\Utils;

use Kingbes\Raylib\Base;
use \FFI\CData;

/**
 * 矩形对象
 */
class Rectangle extends Base
{
    private float $x;
    private float $y;
    private float $width;
    private float $height;

    /**
     * 矩形对象
     *
     * @param float $x x坐标
     * @param float $y y坐标
     * @param float $width 宽度
     * @param float $height 高度
     * @return void
     */
    public function __construct(float $x, float $y, float $width, float $height)
    {
        $this->x = $x;
        $this->y = $y;
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * 矩形对象结构体
     *
     * @return CData
     */
    public function struct(): CData
    {
        $rectangle = self::ffi()->new('struct Rectangle');
        $rectangle->x = $this->x;
        $rectangle->y = $this->y;
        $rectangle->width = $this->width;
        $rectangle->height = $this->height;
        return $rectangle;
    }
}
