<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib\Utils;

use Kingbes\Raylib\Base;
use \FFI\CData;

/**
 * 着色器对象
 * 
 * @property int $id 着色器对象标识符
 */
class Shader extends Base
{
    public readonly int $id; // 着色器对象标识符
    private CData $data;

    public function __construct(CData $cdata)
    {
        $this->data = $cdata;
        $this->id = $cdata->id;
    }

    /**
     * 着色器对象结构体
     *
     * @return CData
     */
    public function struct(): CData
    {
        return $this->data;
    }
}
