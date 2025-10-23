<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib\Utils;

use Kingbes\Raylib\Base;
use \FFI\CData;

/**
 * 变换矩阵对象
 * 
 */
class Transform extends Base
{
    private CData $data;

    public function __construct(CData $cdata)
    {
        $this->data = $cdata;
    }

    /**
     * 变换矩阵对象结构体
     *
     * @return CData
     */
    public function struct(): CData
    {
        return $this->data;
    }
}