<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib\Utils;

use Kingbes\Raylib\Base;
use \FFI\CData;

/**
 * 材质对象
 * 
 * @property int $id 材质对象标识符
 */
class Material extends Base
{
    private CData $data;

    public function __construct(CData $cdata)
    {
        $this->data = $cdata;
    }

    /**
     * 材质对象结构体
     *
     * @return CData
     */
    public function struct(): CData
    {
        return $this->data;
    }
}
