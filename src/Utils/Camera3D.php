<?php

namespace Kingbes\Raylib\Utils;

use \FFI\CData;
use Kingbes\Raylib\Base;

class Camera3D extends Base
{
    public Vector3 $offset;
    public Vector3 $target;
    public Vector3 $up;
    public float $fovy = 0;
    public int $projection = 0;

    /**
     * 构造函数
     *
     * @param CData|array|null|null $source 构造参数，CData对象、数组[offset=>Vector3,target=>Vector3,up=>Vector3,fovy=>float,projection=>int],null
     */
    public function __construct(CData|array|null $source = null)
    {
        if (is_array($source)) {
            $this->offset = $source['offset'];
            $this->target = $source['target'];
            $this->up = $source['up'];
            $this->fovy = $source['fovy'];
            $this->projection = $source['projection'];
        } elseif ($source instanceof CData) {
            $this->offset = $source->offset;
            $this->target = $source->target;
            $this->up = $source->up;
            $this->fovy = $source->fovy;
            $this->projection = $source->projection;
        }
    }

    public function __set($name, $value)
    {
        if (in_array($name, ['offset', 'target', 'up', 'fovy', 'projection'])) {
            $this->$name = $value;
        }
    }

    public function __call($name, $arguments): CData
    {
        if ($name === "ptr") {
            $CDdata = self::ffi()->new("struct Camera3D");
            $CDdata->offset = $this->offset->ptr();
            $CDdata->target = $this->target->ptr();
            $CDdata->up = $this->up->ptr();
            $CDdata->fovy = $this->fovy;
            $CDdata->projection = $this->projection;
            return $CDdata;
        } else {
            throw new \Exception("Camera3D 类不支持 {$name} 方法");
        }
    }
}
