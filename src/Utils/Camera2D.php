<?php

namespace Kingbes\Raylib\Utils;

use \FFI\CData;
use Kingbes\Raylib\Base;

/**
 * 2D相机，定义2d空间中的位置/方向
 */
class Camera2D extends Base
{
    public Vector2 $offset;
    public Vector2 $target;
    public float $rotation = 0;
    public float $zoom = 1;

    /**
     * 构造函数
     *
     * @param CData|array[Vector2]|null $source CData对象、数组[offset=>Vector2,target=>Vector2,rotation=>float,zoom=>float],null
     */
    public function __construct(CData|array|null $source = null)
    {
        if (is_array($source)) {
            $this->offset = $source['offset'];
            $this->target = $source['target'];
            $this->rotation = $source['rotation'];
            $this->zoom = $source['zoom'];
        } elseif ($source instanceof CData) {
            $this->offset = $source->offset;
            $this->target = $source->target;
            $this->rotation = $source->rotation;
            $this->zoom = $source->zoom;
        }
    }

    public function __set($name, $value)
    {
        if (in_array($name, ['offset', 'target', 'rotation', 'zoom'])) {
            $this->$name = $value;
        }
    }

    public function __call($name, $arguments): CData
    {
        if ($name === "ptr") {
            $CDdata = self::ffi()->new("struct Camera2D");
            $CDdata->offset = $this->offset->ptr();
            $CDdata->target = $this->target->ptr();
            $CDdata->rotation = $this->rotation;
            $CDdata->zoom = $this->zoom;
            return $CDdata;
        } else {
            throw new \Exception("Camera2D 类不支持 {$name} 方法");
        }
    }
}
