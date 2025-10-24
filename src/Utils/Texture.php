<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib\Utils;

use Kingbes\Raylib\Base;
use \FFI\CData;

/**
 * 纹理对象
 * 
 * @property int $id 纹理对象标识符
 * @property int $width 纹理宽度
 * @property int $height 纹理高度
 * @property int $mipmaps 纹理MIP地图数量
 * @property int $format 纹理像素格式
 */
class Texture extends Base
{
    public readonly int $id; // 纹理对象标识符
    public readonly int $width; // 纹理宽度
    public readonly int $height; // 纹理高度
    public readonly int $mipmaps; // 纹理MIP地图数量
    public readonly int $format; // 纹理像素格式
    private CData $data;

    /**
     * 纹理对象
     *
     * @param CData $cdata 纹理对象
     * @return void
     */
    public function __construct(CData $cdata)
    {
        $this->id = $cdata->id;
        $this->width = $cdata->width;
        $this->height = $cdata->height;
        $this->mipmaps = $cdata->mipmaps;
        $this->format = $cdata->format;
        $this->data = $cdata;
    }
    
    /**
     * 纹理对象结构体
     *
     * @return CData
     */
    public function struct(): CData
    {
        return $this->data;
    }
}