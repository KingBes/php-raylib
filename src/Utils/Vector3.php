<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib\Utils;

use Kingbes\Raylib\Base;
use \FFI\CData;

/**
 * 向量3对象
 * 
 * @property float $x x轴
 * @property float $y y轴
 * @property float $z z轴
 */
class Vector3 extends Base
{
    public float $x;
    public float $y;
    public float $z;

    /**
     * 向量3对象
     *
     * @param float $x x轴
     * @param float $y y轴
     * @param float $z z轴
     * @return void
     */
    public function __construct(float $x, float $y, float $z)
    {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
    }

    /**
     * 向量3对象结构体
     *
     * @return CData
     */
    public function struct(): CData
    {
        $vector3 = self::ffi()->new('struct Vector3');
        $vector3->x = $this->x;
        $vector3->y = $this->y;
        $vector3->z = $this->z;
        return $vector3;
    }
}
