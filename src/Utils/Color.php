<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib\Utils;

use \FFI\CData;
use Kingbes\Raylib\Base;

/**
 * 颜色类
 */
class Color extends Base
{
    public int $r = 0;
    public int $g = 0;
    public int $b = 0;
    public int $a = 255;

    /**
     * 构造函数
     *
     * @param CData|array[int]|null $source CData对象、数组[r,g,b,a],null
     */
    public function __construct(CData|array|null $source = null)
    {
        if (is_array($source)) {
            $this->r = $source['r'] ?? 0;
            $this->g = $source['g'] ?? 0;
            $this->b = $source['b'] ?? 0;
            $this->a = $source['a'] ?? 255;
        } elseif ($source instanceof CData) {
            $this->r = $source->r;
            $this->g = $source->g;
            $this->b = $source->b;
            $this->a = $source->a;
        }
    }

    public function __set($name, $value)
    {
        if (in_array($name, ['r', 'g', 'b', 'a'])) {
            $this->$name = $value;
        }
    }

    public function __call($name, $arguments): CData
    {
        if ($name === "ptr") {
            $CDdata = self::ffi()->new("struct Color");
            $CDdata->r = $this->r;
            $CDdata->g = $this->g;
            $CDdata->b = $this->b;
            $CDdata->a = $this->a;
            return $CDdata;
        } else {
            throw new \Exception("Color 类不支持 {$name} 方法");
        }
    }
}
