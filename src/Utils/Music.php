<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib\Utils;

use Kingbes\Raylib\Base;
use \FFI\CData;

/**
 * 音乐对象
 * 
 * @property int $frameCount （包括通道在内的）总帧数
 * @property bool $looping 是否循环播放
 * @property int $ctxType 音乐类型背景（音频文件格式）
 */
class Music extends Base
{
    public readonly int $frameCount;
    public bool $looping;
    public readonly int $ctxType;
    private CData $data;

    public function __construct(CData $cdata)
    {
        $this->frameCount = $cdata->frameCount;
        $this->looping = $cdata->looping;
        $this->ctxType = $cdata->ctxType;
        $this->data = $cdata;
    }

    /**
     * 音乐对象结构体
     *
     * @return CData
     */
    public function struct(): CData
    {
        $this->data->looping = $this->looping;
        return $this->data;
    }
}