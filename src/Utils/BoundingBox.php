<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib\Utils;

use Kingbes\Raylib\Base;
use \FFI\CData;

/**
 * 轴对齐边界框对象
 * 
 * @property Vector3 $min 最小点
 * @property Vector3 $max 最大点
 */
class BoundingBox extends Base
{
    public Vector3 $min;
    public Vector3 $max;

    /**
     * 轴对齐边界框对象
     *
     * @param Vector3 $min 最小点
     * @param Vector3 $max 最大点
     */
    public function __construct(
        Vector3 $min,
        Vector3 $max
    ) {
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * 轴对齐边界框对象结构体
     *
     * @return CData
     */
    public function struct(): CData
    {
        $struct = $this::ffi()->new('struct BoundingBox');
        $struct->min = $this->min->struct();
        $struct->max = $this->max->struct();
        return $struct;
    }
}
