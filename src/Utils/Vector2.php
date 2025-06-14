<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib\Utils;

use \FFI\CData;
use Kingbes\Raylib\Base;

/**
 * 向量xy 类
 */
class Vector2 extends Base
{
    public float $x = 0;
    public float $y = 0;

    /**
     * 构造函数
     *
     * @param CData|array[float]|null $source CData对象、数组[x=>float,y=>float],null
     */
    public function __construct(CData|array|null $source = null)
    {
        if (is_array($source)) {
            $this->x = $source['x'] ?? 0;
            $this->y = $source['y'] ?? 0;
        } elseif ($source instanceof CData) {
            $this->x = $source->x;
            $this->y = $source->y;
        }
    }

    public function __set($name, $value)
    {
        if (in_array($name, ['x', 'y'])) {
            $this->$name = $value;
        }
    }

    public function __call($name, $arguments): CData
    {
        if ($name === "ptr") {
            $CDdata = self::ffi()->new("struct Vector2");
            $CDdata->x = $this->x;
            $CDdata->y = $this->y;
            return $CDdata;
        } else {
            throw new \Exception("Vector2 类不支持 {$name} 方法");
        }
    }
}
