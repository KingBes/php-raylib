<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib\Utils;

use Kingbes\Raylib\Base;
use \FFI\CData;

/**
 * 波，音频波数据
 * 
 * @property int $frameCount （包括通道在内的）总帧数
 * @property int $sampleCount 频率（每秒采样次数）
 * @property int $sampleSize 样本大小（每个样本的位数）：8、16、32（不支持 24）
 * @property int $channels 声道数量（1 - 单声道，2 - 立体声，...）
 */
class Wave extends Base
{
    public readonly int $frameCount;
    public readonly int $sampleCount;
    public readonly int $sampleSize;
    public readonly int $channels;
    private CData $data;

    public function __construct(CData $cdata)
    {
        $this->frameCount = $cdata->frameCount;
        $this->sampleCount = $cdata->sampleCount;
        $this->sampleSize = $cdata->sampleSize;
        $this->channels = $cdata->channels;
        $this->data = $cdata;
    }

    /**
     * 音频波数据结构体
     *
     * @return CData
     */
    public function struct(): CData
    {
        return $this->data;
    }
}
