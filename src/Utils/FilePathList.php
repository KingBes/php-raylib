<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib\Utils;

use Kingbes\Raylib\Base;
use \FFI\CData;

/**
 * 文件路径列表对象
 * 
 * @property int $capacity 最大条目数
 * @property int $count 当前条目数
 */
class FilePathList extends Base
{
    public readonly int $capacity; // 最大条目数
    public readonly int $count; // 当前条目数
    private CData $data;

    public function __construct(CData $cdata)
    {
        $this->capacity = $cdata->capacity;
        $this->count = $cdata->count;
        $this->data = $cdata;
    }

    /**
     * 文件路径列表对象结构体
     *
     * @return CData
     */
    public function struct(): CData
    {
        return $this->data;
    }
}
