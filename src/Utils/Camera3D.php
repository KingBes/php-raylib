<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib\Utils;

use Kingbes\Raylib\Base;
use \FFI\CData;

/**
 * 相机3D对象
 * 
 * @property Vector3 $position 相机位置
 * @property Vector3 $target 相机目标点
 * @property Vector3 $up 相机上方向向量
 * @property float $fovy 相机垂直视野角度（FOV）
 * @property bool $projection true:正投影法 false:透视投影
 */
class Camera3D extends Base
{
    public Vector3 $position; // 相机位置
    public Vector3 $target; // 相机目标点
    public Vector3 $up; // 相机上方向向量
    public float $fovy; // 相机垂直视野角度（FOV）
    public bool $projection; // true:正投影法 false:透视投影

    public function __construct(
        Vector3 $position,
        Vector3 $target,
        Vector3 $up,
        float $fovy,
        bool $projection = false
    ) {
        $this->position = $position;
        $this->target = $target;
        $this->up = $up;
        $this->fovy = $fovy;
        $this->projection = $projection;
    }

    /**
     * 相机3D对象结构体
     *
     * @return CData
     */
    public function struct(): CData
    {
        $camera3d = self::ffi()->new('struct Camera3D');
        $camera3d->position = $this->position->struct();
        $camera3d->target = $this->target->struct();
        $camera3d->up = $this->up->struct();
        $camera3d->fovy = $this->fovy;
        $camera3d->projection = $this->projection ? 1 : 0;
        return $camera3d;
    }
}
