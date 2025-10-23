<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib\Utils;

use Kingbes\Raylib\Base;
use \FFI\CData;

/**
 * 网格、顶点数据以及 vao/vbo
 */
class Mesh extends Base
{
    private CData $data;

    public function __construct(CData $cdata)
    {
        $this->data = $cdata;
    }

    /**
     * 网格对象结构体
     *
     * @return CData
     */
    public function struct(): CData
    {
        return $this->data;
    }
}
