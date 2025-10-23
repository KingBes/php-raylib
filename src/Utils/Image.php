<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib\Utils;

use Kingbes\Raylib\Base;
use \FFI\CData;

/**
 * 图像对象
 * 
 * @property int $width 图像宽度
 * @property int $height 图像高度
 * @property int $mipmaps 图像MIP地图数量
 * @property int $format 图像像素格式
 */
class Image extends Base
{
    public readonly int $width;
    public readonly int $height;
    public readonly int $mipmaps;
    public readonly int $format;
    private CData $data;

    /**
     * 图像对象
     *
     * @param CData $cdata 图像对象
     * @return void
     */
    public function __construct(CData $cdata)
    {
        $this->width = $cdata->width;
        $this->height = $cdata->height;
        $this->mipmaps = $cdata->mipmaps;
        $this->format = $cdata->format;
        $this->data = $cdata->data;
    }

    /**
     * 图像对象结构体
     *
     * @return CData
     */
    public function struct(): CData
    {
        return $this->data;
    }
}
