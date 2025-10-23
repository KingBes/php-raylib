<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib\Utils;

use Kingbes\Raylib\Base;
use \FFI\CData;

/**
 * 射线对象
 * 
 * @property Vector3 $position  射线起点
 * @property Vector3 $direction 射线方向
 */
class Ray extends Base
{
    public Vector3 $position;  // 射线起点
    public Vector3 $direction; // 射线方向

    public function __construct(Vector3 $position, Vector3 $direction)
    {
        $this->position = $position;
        $this->direction = $direction;
    }

    /**
     * 射线对象结构体
     *
     * @return CData
     */
    public function struct(): CData
    {
        $struct = $this::ffi()->new('struct Ray');
        $struct->position = $this->position->struct();
        $struct->direction = $this->direction->struct();
        return $struct;
    }
}
