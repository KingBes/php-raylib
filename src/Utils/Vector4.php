<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib\Utils;

use Kingbes\Raylib\Base;
use \FFI\CData;

/**
 * 向量4对象
 * 
 * @property float $x x轴
 * @property float $y y轴
 * @property float $z z轴
 * @property float $w w轴
 */
class Vector4 extends Base
{
    public float $x;
    public float $y;
    public float $z;
    public float $w;

    /**
     * 向量4对象
     *
     * @param float $x x轴
     * @param float $y y轴
     * @param float $z z轴
     * @param float $w w轴
     * @return void
     */
    public function __construct(float $x, float $y, float $z, float $w)
    {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
        $this->w = $w;
    }

    /**
     * 向量4对象结构体
     *
     * @return CData
     */
    public function struct(): CData
    {
        $vector4 = self::ffi()->new('struct Vector4');
        $vector4->x = $this->x;
        $vector4->y = $this->y;
        $vector4->z = $this->z;
        $vector4->w = $this->w;
        return $vector4;
    }
}