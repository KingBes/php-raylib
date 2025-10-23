<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib\Utils;

use Kingbes\Raylib\Base;
use \FFI\CData;

/**
 * 相机2D对象
 * 
 * @property Vector2 $offset 相机偏移量
 * @property Vector2 $target 相机目标点
 * @property float $rotation 相机旋转角度（弧度）
 * @property float $zoom 相机缩放比例
 */
class Camera2D extends Base
{
    public Vector2 $offset; // 相机偏移量
    public Vector2 $target; // 相机目标点
    public float $rotation; // 相机旋转角度（弧度）
    public float $zoom; // 相机缩放比例

    public function __construct(
        Vector2 $offset,
        Vector2 $target,
        float $rotation,
        float $zoom = 1.0
    ) {
        $this->offset = $offset;
        $this->target = $target;
        $this->rotation = $rotation;
        $this->zoom = $zoom;
    }

    /**
     * 相机2D对象结构体
     *
     * @return CData
     */
    public function struct(): CData
    {
        $camera2d = self::ffi()->new('struct Camera2D');
        $camera2d->offset = $this->offset->struct();
        $camera2d->target = $this->target->struct();
        $camera2d->rotation = $this->rotation;
        $camera2d->zoom = $this->zoom;
        return $camera2d;
    }
}
