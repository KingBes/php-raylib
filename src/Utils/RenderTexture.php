<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib\Utils;

use Kingbes\Raylib\Base;
use \FFI\CData;

/**
 * 渲染纹理对象
 * 
 * @property int $id 渲染纹理对象标识符
 * @property Texture $texture 颜色缓冲区附加纹理
 * @property Texture $depth 深度缓冲区附加纹理
 */
class RenderTexture extends Base
{
    public readonly int $id; // 渲染纹理对象标识符
    public Texture $texture; // 颜色缓冲区附加纹理
    public Texture $depth; // 深度缓冲区附加纹理
    private CData $data;

    public function __construct(CData $cdata)
    {
        $this->id = $cdata->id;
        $this->texture = new Texture($cdata->texture);
        $this->depth = new Texture($cdata->depth);
        $this->data = $cdata;
    }

    /**
     * 渲染纹理对象结构体
     *
     * @return CData
     */
    public function struct(): CData
    {
        $this->data->texture = $this->texture->struct();
        $this->data->depth = $this->depth->struct();
        return $this->data;
    }
}