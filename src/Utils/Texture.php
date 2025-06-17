<?php

namespace Kingbes\Raylib\Utils;

use \FFI\CData;
use Kingbes\Raylib\Base;

class Texture extends Base
{
    public int $id; // OpenGL纹理id
    public int $width; // 纹理宽度
    public int $height; // 纹理高度
    public int $mipmaps; // 纹理mipmap层级
    public int $format; // 纹理格式 像素格式类型

    /**
     * 构造函数 
     *
     * @param CData|array|null $source 构造参数，CData对象、数组[id=>int,width=>int,height=>int,mipmaps=>int,format=>int],null
     */
    public function __construct(CData|array|null $source = null)
    {
        if (is_array($source)) {
            $this->id = $source['id'];
            $this->width = $source['width'];
            $this->height = $source['height'];
            $this->mipmaps = $source['mipmaps'];
            $this->format = $source['format'];
        } elseif ($source instanceof CData) {
            $this->id = $source->id;
            $this->width = $source->width;
            $this->height = $source->height;
            $this->mipmaps = $source->mipmaps;
            $this->format = $source->format;
        }
    }
}
