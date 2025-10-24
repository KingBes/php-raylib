<?php

// 严格模式
declare(strict_types=1);

namespace Kingbes\Raylib\Utils;

use Kingbes\Raylib\Base;
use \FFI\CData;

/**
 * 字体对象
 * 
 * @property int $baseSize 字体基础大小
 * @property int $glyphCount 字体字符数量
 * @property int $glyphPadding 字体字符间距
 */
class Font extends Base
{
    public int $baseSize; // 字体基础大小
    public int $glyphCount; // 字体字符数量
    public int $glyphPadding; // 字体字符间距
    private CData $data;

    public function __construct(CData $cdata)
    {
        $this->baseSize = $cdata->baseSize;
        $this->glyphCount = $cdata->glyphCount;
        $this->glyphPadding = $cdata->glyphPadding;
        $this->data = $cdata;
    }

    /**
     * 字体对象结构体
     *
     * @return CData
     */
    public function struct(): CData
    {
        $this->data->baseSize = $this->baseSize;
        $this->data->glyphCount = $this->glyphCount;
        $this->data->glyphPadding = $this->glyphPadding;
        return $this->data;
    }
}
