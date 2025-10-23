<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib\Utils;

use Kingbes\Raylib\Base;
use \FFI\CData;

/**
 * 射线碰撞对象
 * 
 * @property boolean $hit 是否碰撞
 * @property float $distance 碰撞距离
 * @property Vector3 $point 碰撞点
 * @property Vector3 $normal 碰撞法线
 */
class RayCollision extends Base
{
    public bool $hit;
    public float $distance;
    public Vector3 $point;
    public Vector3 $normal;

    /**
     * 射线碰撞对象
     *
     * @param boolean $hit 是否碰撞
     * @param float $distance 碰撞距离
     * @param Vector3 $point 碰撞点
     * @param Vector3 $normal 碰撞法线
     */
    public function __construct(
        bool $hit,
        float $distance,
        Vector3 $point,
        Vector3 $normal
    ) {
        $this->hit = $hit;
        $this->distance = $distance;
        $this->point = $point;
        $this->normal = $normal;
    }

    /**
     * 射线碰撞对象结构体
     *
     * @return CData
     */
    public function struct(): CData
    {
        $struct = $this::ffi()->new('struct RayCollision');
        $struct->hit = $this->hit;
        $struct->distance = $this->distance;
        $struct->point = $this->point->struct();
        $struct->normal = $this->normal->struct();
        return $struct;
    }
}
