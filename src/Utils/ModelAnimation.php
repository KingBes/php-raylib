<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib\Utils;

use Kingbes\Raylib\Base;
use \FFI\CData;

/**
 * 模型动画对象
 * 
 * @property int $id 模型动画对象标识符
 */
class ModelAnimation extends Base
{
    private CData $data;

    public function __construct(CData $cdata)
    {
        $this->data = $cdata;
    }

    /**
     * 模型动画对象结构体
     *
     * @return CData
     */
    public function struct(): CData
    {
        return $this->data;
    }
}