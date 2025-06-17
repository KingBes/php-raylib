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
     */
    public function __construct() {}

    public function __call($name, $arguments): CData
    {
        if ($name === "ptr") {
            if (!isset($this->CData)) {
                throw new \Exception("Image->CData 未被赋值");
            }
            return $this->CData;
        } else {
            throw new \Exception("Image 类不支持 {$name} 方法");
        }
    }
}
