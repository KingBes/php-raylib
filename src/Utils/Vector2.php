<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib\Utils;

use Kingbes\Raylib\Base;
use \FFI\CData;

/**
 * 向量2对象
 * 
 * @property float $x x轴
 * @property float $y y轴
 */
class Vector2 extends Base
{
    public float $x;
    public float $y;

    /**
     * 向量2对象
     *
     * @param float $x x轴
     * @param float $y y轴
     * @return void
     */
    public function __construct(float $x, float $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * 向量2对象结构体
     *
     * @return CData
     */
    public function struct(): CData
    {
        $vector2 = self::ffi()->new('struct Vector2');
        $vector2->x = $this->x;
        $vector2->y = $this->y;
        return $vector2;
    }
}
