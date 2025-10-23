<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib\Utils;

use Kingbes\Raylib\Base;
use \FFI\CData;

/**
 * 颜色对象
 */
class Color extends Base
{
    public int $r;
    public int $g;
    public int $b;
    public int $a;

    /**
     * 颜色对象
     *
     * @param integer $r 红 0-255
     * @param integer $g 绿 0-255
     * @param integer $b 蓝 0-255
     * @param integer $a 透明度 0-255
     * @return void
     */
    public function __construct(int $r, int $g, int $b, int $a = 255)
    {
        $this->r = $r;
        $this->g = $g;
        $this->b = $b;
        $this->a = $a;
    }

    /**
     * 颜色对象结构体
     *
     * @return CData
     */
    public function struct(): CData
    {
        $color = self::ffi()->new('struct Color');
        $color->r = $this->r;
        $color->g = $this->g;
        $color->b = $this->b;
        $color->a = $this->a;
        return $color;
    }
}
