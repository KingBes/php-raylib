<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib\Utils;

use Kingbes\Raylib\Base;
use \FFI\CData;

/**
 * 音频流，自定义音频流
 * 
 * @property int $sampleRate 采样率（每秒采样次数）
 * @property int $sampleSize 样本大小（每个样本的位数）：8、16、32（不支持 24）
 * @property int $channels 声道数量（1 - 单声道，2 - 立体声，...）
 */
class AudioStream extends Base
{
    public int $sampleRate;
    public int $sampleSize;
    public int $channels;
    private CData $data;

    public function __construct(CData $cdata)
    {
        $this->sampleRate = $cdata->sampleRate;
        $this->sampleSize = $cdata->sampleSize;
        $this->channels = $cdata->channels;
        $this->data = $cdata;
    }

    /**
     * 音频流结构体
     *
     * @return CData
     */
    public function struct(): CData
    {
        return $this->data;
    }
}
