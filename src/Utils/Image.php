<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib\Utils;

use \FFI\CData;
use Kingbes\Raylib\Base;

class Image extends Base
{
    public CData $CData;

    /**
     * 构造函数
     *
     * @param string $source 图像字符串路径
     */
    public function __construct(string $source = "")
    {
        if ($source !== "") {
            $this->CData = self::ffi()->LoadImage($source);
        }
    }

    public function __call($name, $arguments): CData
    {
        if ($name === "ptr") {
            return $this->CData;
        } else {
            throw new \Exception("Image 类不支持 {$name} 方法");
        }
    }
}
