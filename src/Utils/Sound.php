<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib\Utils;

use Kingbes\Raylib\Base;
use \FFI\CData;

/**
 * 声音对象
 * 
 * @property int $frameCount （包括通道在内的）总帧数
 */
class Sound extends Base
{
    public readonly int $frameCount;
    private CData $data;

    public function __construct(CData $cdata)
    {
        $this->frameCount = $cdata->frameCount;
        $this->data = $cdata;
    }

    /**
     * 声音对象结构体
     *
     * @return CData
     */
    public function struct(): CData
    {
        return $this->data;
    }
}
